<?php

namespace Modules\Smsreader\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Account\Classes\Gateway as ClsGateway;
use Modules\Account\Classes\Payment as ClsPayment;
use Modules\Account\Entities\Invoice;
use Modules\Base\Http\Controllers\BaseController;
use Modules\Smsreader\Entities\Incoming;
use Modules\Smsreader\Entities\Payment;

class IncomingController extends BaseController
{

    public function incoming(Request $request)
    {
        $result = [];

        $data = $request->all();

        try {
            $phone = $data['from'] ?? $data['sender'] ?? $data['phone'] ?? '';
            $message = $data['message'] ?? $data['text'] ?? '';
            $date_sent_str = $data['sentStamp'] ?? $data['date_sent'] ?? $data['datesent'] ?? '';
            $date_received_str = $data['receivedStamp'] ?? $data['timestamp'] ?? '';

            $date_sent = $date_received = null;

            if ($date_sent_str != '') {
                [$date, $time] = explode(' ', $date_sent_str);
                $carbonDate = Carbon::createFromFormat('M/d/Y', $date);
                $carbonTime = Carbon::parse($time);
                $date_sent = $carbonDate->format('Y-m-d') . ' ' . $carbonTime->format('H:i:s');
            }

            if ($date_received_str != '') {
                [$date, $time] = explode(' ', $date_received_str);
                $carbonDate = Carbon::createFromFormat('M/d/Y', $date);
                $carbonTime = Carbon::parse($time);
                $date_received = $carbonDate->format('Y-m-d') . ' ' . $carbonTime->format('H:i:s');
            }

            if ($message != '') {
                Incoming::create([
                    'phone' => $phone,
                    'message' => $message,
                    'date_sent' => $date_sent,
                    'date_received' => $date_received,
                    'sim' => (isset($data['sim'])) ? $data['sim'] : '',
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        return response()->json(['status' => true, 'message' => 'SMS added successfully.']);
    }

    public function paymentVerification(Request $request)
    {
        $cls_payment = new ClsPayment();
        $cls_gateway = new ClsGateway();

        $result = [];
        $data = $request->all();

        $invoice = Invoice::where('id', $data['invoice_id'])->first();

        $payment = Payment::where('code', $data['code_reference'])
            ->where('completed', false)
            ->first();

        $gateway = $cls_gateway->getGatewayBySlug('smsreader');

        $title = 'Payment of ' . $payment->amount . ' Code [' . $payment->code . '] By ' . $payment->name . ' ' . $payment->phone;
        $amount = $payment->amount;
        $gateway_id = $gateway->id;
        $partner_id = $invoice->partner_id;
        $invoice_id = $invoice->id;
        $code = $payment->code;
        $reference = $payment->code;

        $result = ['status' => false, 'message' => 'Error: Payment does not exist.'];

        if ($payment) {

            $payment->completed = true;
            $payment->successful = true;
            $payment->save();

            $cls_payment->makePayment($partner_id, $title, $amount, $gateway_id, invoice_id:$invoice_id, code:$code, reference:$reference);

            $result = ['status' => true, 'message' => 'Payment was successfully.'];

        }

        return response()->json($result);

    }

}
