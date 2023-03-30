<?php

namespace Modules\Smsreader\Classes;

use Modules\Partner\Entities\Partner;

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

        $tabs = [];
        $send_direct = view('smsreader::payment', $data)->toHtml();
        $tabs =array(
            ['title' => 'Send Direct', 'slug' => 'SendDirect', 'gateway' => $gateway, 'html' => $send_direct]
        );
 

        return $tabs;
    }

}
