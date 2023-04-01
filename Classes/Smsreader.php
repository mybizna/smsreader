<?php

namespace Modules\Smsreader\Classes;

use Modules\Account\Classes\Gateway as GatewayCls;
use Modules\Account\Classes\Payment as PaymentCls;
use Modules\Partner\Classes\Partner;
use Modules\Smsreader\Entities\Account;
use Modules\Smsreader\Entities\Format;
use Modules\Smsreader\Entities\Payment;
use Modules\Smsreader\Entities\Requests;
use Modules\Smsreader\Entities\Incoming;
use Modules\Smsreader\Entities\Template;

class Smsreader
{

    public function processIncoming($incoming)
    {
        $this->processFormat($incoming);

        $incomings = Incoming::where(['completed' => false])->get();

        foreach ($incomings as $key => $incoming) {
            $this->processFormat($incoming);
        }
    }

    protected function processFormat($incoming)
    {
        $partner_cls = new Partner();

        $partner_id = '';

        $formatings = Format::where([['slug', '<>', 'account'], 'published' => true])->get();
        $account = Format::where(['slug' => 'account'])->first();
        $account_parts = [];

        preg_match_all('/^' . $account->format . '/', preg_replace('/\s+/', ' ', $incoming->message), $account_parts, PREG_SET_ORDER);

        if (isset($account_parts[0])) {
            $partner = $partner_cls->getPartner($account_parts[0][1]);

            if ($partner) {
                $partner_id = $partner->id;

                Account::updateOrCreate([
                    'partner_id' => $partner->id,
                    'account' => $account_parts[0][1],
                    'txn' => $account_parts[0][2],
                ]);

                $payment = Payment::where('code', $account_parts[0][2])->first();

                if ($payment) {
                    $this->paymentSuccessful($payment, $partner);
                }
            }

            $incoming->completed = true;
            $incoming->is_payment = false;
            $incoming->save();

            return;
        }

        $is_payment = false;

        foreach ($formatings as $key => $formating) {

            $payment = $this->analyzeFormat($formating, $incoming);
           
            if ($payment) {
                if ($payment->account == '') {
                    $account = Account::where('txn', $payment->code)->first();
                    if ($account) {
                        $payment->account = $account->account;
                    }
                }
            } else {
                $is_payment = true;
            }

            if ($payment) {

                if ($payment->account == '') {
                    if ($payment->request_type == 'customer_not_found') {

                        $this->sendMessage('customer_not_found_again', $payment);
                        $payment->request_type = 'customer_not_found_again';
                        $payment->save();
                    } else {
                        $this->sendMessage('customer_not_found', $payment);
                        $payment->request_type = 'customer_not_found';
                        $payment->save();
                    }

                } elseif ($payment->account) {

                    $partner = $partner_cls->getPartner($payment->account);
                    
                    if ($partner) {
                        $this->paymentSuccessful($payment, $partner);
                    } else {
                        if ($payment->request_type == 'customer_not_found' or $payment->request_type == 'customer_not_found_again') {
                            $this->sendMessage('customer_not_found_again', $payment);
                        } else {
                            $this->sendMessage('customer_not_found', $payment);
                        }}

                    if ($payment->partner_id) {
                        $this->sendMessage('payment_successful', $payment);
                    }
                }
            }

            $incoming->completed = true;
            $incoming->is_payment = $is_payment;
            $incoming->save();

        }
    }

    protected function analyzeFormat($formating, $incoming)
    {
        $message_parts = [];

        preg_match_all('/^' . $formating->format . '/', $incoming->message, $message_parts, PREG_SET_ORDER);

        if (isset($message_parts[0]) && $formating->fields_str) {
            $analysis = ['name' => '', 'phone' => '', 'code' => '', 'date' => '', 'message_id' => $incoming->id,
                'time' => '', 'amount' => '', 'account' => '', 'format_id' => $formating->id,
            ];

            $fields = explode(',', $formating->fields_str);
            $num = 1;

            foreach ($fields as $key => $field) {
                if ($field == 'name') {
                    $analysis['name'] = $message_parts[0][$num];
                }
                if ($field == 'phone') {
                    $phone = $message_parts[0][$num];
                    $suffix = substr($phone, -9);
                    $prefix = 254;
                    $phone = strval($prefix) . strval($suffix);
                    $analysis['phone'] = $phone;
                }
                if ($field == 'code') {
                    $analysis['code'] = $message_parts[0][$num];
                }
                if ($field == 'date') {
                    $analysis['date'] = $message_parts[0][$num];
                }
                if ($field == 'time') {
                    $analysis['time'] = $message_parts[0][$num];
                }
                if ($field == 'amount') {
                    $analysis['amount'] = floatval(preg_replace('/[^0-9]/', '', $message_parts[0][$num]));
                }
                if ($field == 'account') {
                    $analysis['account'] = $message_parts[0][$num];
                }

                $num = $num + 1;
            }

            if ($analysis['account'] == '') {
                $analysis['account'] = $analysis['phone'];
            }

            $datetime_str = date('Y-m-d H:i:s', strtotime($analysis['date'] . " " . $analysis['time']));

            $analysis['date_sent'] = $datetime_str;

            return Payment::create($analysis);

        }

        return false;

    }

    protected function sendMessage($slug, $payment)
    {

        $admin_phone = \Config::get('core.company_phone');

        $phone = $invoice_id = $note = $amount = '';

        if ($payment) {
            $account = $payment->account ?? '';
            $phone = $payment->phone ?? '';
            $note = $payment->note ?? '';
            $amount = $payment->amount ?? '';
        }

        $message = 'Unknown issue prease contact admin ' . $admin_phone;

        $template = Template::where(['slug' => $slug])->first();

        $message = $template->template;

        $message = str_replace('[ACCOUNT]', $account, $message);
        $message = str_replace('[PHONE]', $phone, $message);
        $message = str_replace('[NOTE]', $note, $message);
        $message = str_replace('[AMOUNT]', $amount, $message);
        $message = str_replace('[ADMIN_PHONE]', $admin_phone, $message);

        Requests::updateOrCreate([
            'phone' => $payment->phone,
            'payment_id' => $payment->id,
            'message' => $message,
            'date_sent' => date("Y-m-d H:i:s"),
        ]);
    }

    protected function paymentSuccessful($payment, $partner)
    {
        $payment_cls = new PaymentCls();
        $gateway_cls = new GatewayCls();

        $payment->partner_id = $partner->id;
        $payment->save();

        $gateway = $gateway_cls->getGatewayBySlug('mpesa');
        $amount = $payment->amount;
        $title = "Payment of $payment->amount from $payment->phone via $gateway->title ";

        $payment_cls->addPayment($partner->id, $title, $amount, $gateway->id);
    }

}
