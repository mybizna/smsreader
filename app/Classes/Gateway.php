<?php

namespace Modules\Smsreader\Classes;

use Modules\Partner\Models\Partner;

class Gateway
{
    public function getGatewayTab($gateway, $invoice)
    {
        $data = [
            'invoice' => $invoice,
            'gateway' => $gateway,
            'short_code' => '2323232',
        ];

        if ($invoice->partner_id) {
            $data['partner'] = Partner::where(['id' => $invoice->partner_id])->first();

            if ($data['partner']) {
                $data['phone'] = $data['partner']->phone;
            }
        }

        $data['send_instruction'] = \Config::get('smsreader.send_instruction');

        $tabs = [];

        $send_direct = view('smsreader::payment', $data)->toHtml();

        $is_active = \Config::get('smsreader.is_active');
        if ($is_active) {
            $tabs = array(
                ['title' => 'Send Direct', 'slug' => 'SendDirect', 'gateway' => $gateway, 'html' => $send_direct],
            );
        }

        return $tabs;
    }

}
