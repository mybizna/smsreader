<?php

namespace Modules\Smsreader\Entities\Data;

use Modules\Base\Classes\Datasetter;
use Illuminate\Support\Facades\DB;

class Format
{

    public $ordering = 4;

    public function data(Datasetter $datasetter)
    {

        $datasetter->add_data('smsreader', 'format', 'slug', [
            "title" => "Paybill Number",
            "slug" => "paybill_number",
            "format" => '(.*) Confirmed. on (.*) at (.*) (.*) received from (.*) (.*).  Account Number (.*) New Utility balance',
            "fields_str" => 'code, date,time,amount,name,phone,account',
            "published" => true
        ]);

        $datasetter->add_data('smsreader', 'format', 'slug', [
            "title" => "Personal Number",
            "slug" => "personal_number",
            "format" => '(.*) Confirmed.You have received (.*) from (.*) (.*) on (.*) at (.*) New M-PESA balance is (.*).',
            "fields_str" => 'code,amount,name,phone,date,time',
            "published" => true
        ]);

        $datasetter->add_data('smsreader', 'format', 'slug', [
            "title" => "Account",
            "slug" => "account",
            "format" => 'ACCOUNT (.*) TXN (.*)',
            "fields_str" => 'account',
            "published" => true
        ]);


    }
}
