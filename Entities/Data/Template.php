<?php

namespace Modules\Smsreader\Entities\Data;

use Modules\Base\Classes\Datasetter;
use Illuminate\Support\Facades\DB;

class Template
{
    /**
     * Set ordering of the Class to be migrated.
     * @var int
     */
    public $ordering = 4;


/**
 * Run the database seeds with system default records.
 *
 * @return void
 */

    public function data(Datasetter $datasetter): void
    {

        $datasetter->add_data('smsreader', 'template', 'slug', [
            "title" => "Customer Not Found",
            "slug" => "customer_not_found",
            "template" => 'We have received your payment and we need your account name.Please contact Admin [ADMIN_PHONE] or Forward your payment SMS to [ADMIN_PHONE] or reply with following; ACCOUNT XXXXXX  TXN XXXXXX ',
            "published" => true
        ]);

        $datasetter->add_data('smsreader', 'template', 'slug', [
            "title" => "Payment Sucessful",
            "slug" => "payment_successful",
            "template" => 'Hi [Name]. Payment of [AMOUNT] with code [CODE] was Successful. For more info call [ADMIN_PHONE]',
            "published" => true
        ]);


        $datasetter->add_data('smsreader', 'template', 'slug', [
            "title" => "Payment Failed",
            "slug" => "payment_failed",
            "template" => 'Payment Failed. Please contact Admin [ADMIN_PHONE]',
            "published" => true
        ]);

        $datasetter->add_data('smsreader', 'template', 'slug', [
            "title" => "No Payment to Confirm",
            "slug" => "no_payment_confirm",
            "template" => 'ERROR: There is no payment sent with code [CODE]. Please contact Admin [ADMIN_PHONE]',
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
