<?php

namespace Modules\Smsreader\Classes;

use Modules\Account\Classes\Gateway as GatewayCls;
use Modules\Account\Classes\Payment as PaymentCls;
use Modules\Partner\Classes\Partner;
use Modules\Partner\Entities\Partner as DBPartner;
use Modules\Smsreader\Entities\Account;
use Modules\Smsreader\Entities\Confirming;
use Modules\Smsreader\Entities\Format;
use Modules\Smsreader\Entities\Incoming;
use Modules\Smsreader\Entities\Payment;
use Modules\Smsreader\Entities\Requests;
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

        $formatings = Format::where(['published' => true])->get();

        foreach ($formatings as $key => $formating) {

            list($processed, $analysis) = $this->analyzeFormat($formating, $incoming);

            if ($processed) {

                if ($formating->action == "payment") {
                    $payment = Payment::create($analysis);

                    $this->processPayment($payment, $incoming);

                    $incoming->is_payment = true;
                }

                if ($formating->action == "confirming") {

                    $confirm = Confirming::create($analysis);

                    $payment = Payment::where(['code' => $analysis['code']])->first();

                    if ($payment) {
                        if ($payment->phone == '') {
                            $payment->phone = $incoming->phone;
                        }

                        $this->processPayment($payment, $incoming);

                        $incoming->successful = true;
                    } else {
                        $this->sendMessage('no_payment_confirm', $confirm);
                    }
                    $incoming->completed = true;
                }

                if ($formating->action == "account") {

                    $payment = Payment::where('phone', 'LIKE', '%' . substr($incoming->phone, -9) . '%')
                        ->where('completed', false)
                        ->first();

                    if (isset($analysis['code'])) {
                        $tmp_payment = Payment::where('code', $analysis['code'])
                            ->where('completed', false)
                            ->first();
                        if ($tmp_payment) {
                            $payment = $tmp_payment;
                        }
                    }

                    $payment->account = $analysis['account'];

                    $this->processPayment($payment, $incoming);

                    $incoming->completed = true;
                }

                $incoming->save();

                break;
            }

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
                    $analysis['amount'] = floatval(preg_replace('/[^0-9\.]/', '', $message_parts[0][$num]));
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

            return [true, $analysis];

        }

        return [false, []];

    }

    protected function processPayment($payment, $incoming)
    {
        $search_partner_by_phone = \Config::get('smsreader.search_partner_by_phone');

        $partner = false;
        if ($search_partner_by_phone) {
            $partner = DBPartner::where('id', $partner_id)->first();
        } elseif ($payment->account) {
            $partner = $partner_cls->getPartner($payment->account);
        }

        if ($partner) {

            $this->paymentSuccessful($payment, $partner);

            $incoming->completed = true;
            $incoming->successful = true;
            $incoming->save();

            $this->sendMessage('payment_successful', $payment);

        } else {
            if ($payment->request_type == 'customer_not_found' or $payment->request_type == 'customer_not_found_again') {
                $this->sendMessage('customer_not_found_again', $payment);
            } else {
                $this->sendMessage('customer_not_found', $payment);
            }

        }
    }

    protected function sendMessage($slug, $payment)
    {
        $admin_phone = \Config::get('core.company_phone');

        $phone = $invoice_id = $note = $amount = $code = '';

        if ($payment) {
            $code = $payment->code ?? '';
            $account = $payment->account ?? '';
            $phone = $payment->phone ?? '';
            $note = $payment->note ?? '';
            $amount = $payment->amount ?? '';
        }

        $message = 'Unknown issue please contact admin ' . $admin_phone;

        $template = Template::where(['slug' => $slug])->first();

        $message = $template->template;

        $message = str_replace('[ACCOUNT]', $account, $message);
        $message = str_replace('[CODE]', $code, $message);
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

        if ($payment instanceof Payment) {
            $payment->request_type = $slug;
            $payment->save();
        }
    }

    protected function paymentSuccessful($payment, $partner)
    {
        $payment_cls = new PaymentCls();
        $gateway_cls = new GatewayCls();

        $payment->partner_id = $partner->id;
        $payment->save();

        $gateway = $gateway_cls->getGatewayBySlug('smsreader');
        $amount = $payment->amount;
        $title = "Payment of $payment->amount from $payment->phone via $gateway->title ";

        $payment_cls->addPayment($partner->id, $title, $amount, $gateway->id);
    }

}
