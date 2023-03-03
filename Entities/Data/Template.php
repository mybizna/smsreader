<?php

namespace Modules\Smsreader\Entities\Data;

use Modules\Base\Classes\Datasetter;
use Illuminate\Support\Facades\DB;

class Template
{

    public $ordering = 4;

    public function data(Datasetter $datasetter)
    {

        $datasetter->add_data('smsreader', 'template', 'slug', [
            "title" => "Customer Not Found",
            "slug" => "customer_not_found",
            "template" => 'We have received your payment and we need your account name. Please contact Admin [ADMIN_PHONE] or reply with following; ACCOUNT XXXXXX  TXN XXXXXX ',
            "published" => true
        ]);

        $datasetter->add_data('smsreader', 'template', 'slug', [
            "title" => "Customer Found With Many Invoices",
            "slug" => "customer_found_with_invoices",
            "template" => 'Hi [Name]. Following are active invoices;[INVOICES]. Reply.',
            "published" => true
        ]);

        $datasetter->add_data('smsreader', 'template', 'slug', [
            "title" => "Payment Sucessful",
            "slug" => "payment_successful",
            "template" => 'Hi [Name]. Payment Successful. Payment of [AMOUNT] was made to invoice [INVOICE_ID] [NOTE]. For more info call [ADMIN_PHONE]',
            "published" => true
        ]);


        $datasetter->add_data('smsreader', 'template', 'slug', [
            "title" => "Payment Failed",
            "slug" => "payment_failed",
            "template" => 'Payment Failed. Please contact Admin [ADMIN_PHONE]',
            "published" => true
        ]);


        $datasetter->add_data('smsreader', 'template', 'slug', [
            "title" => "Pending Request for Info",
            "slug" => "pending_request_info",
            "template" => 'There is a pending requesting for more information from previous payment. To correct it, please contact Admin [ADMIN_PHONE]',
            "published" => true
        ]);

        $datasetter->add_data('smsreader', 'template', 'slug', [
            "title" => "Customer Not Found Again",
            "slug" => "customer_not_found_again",
            "template" => '[ACCOUNT] was not Found. Please contact Admin [ADMIN_PHONE] or reply with following: ACCOUNT XXXXXX TXN XXXXXX ',
            "published" => true
        ]);


    }
}