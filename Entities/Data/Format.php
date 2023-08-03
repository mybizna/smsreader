<?php

namespace Modules\Smsreader\Entities\Data;

use Modules\Base\Classes\Datasetter;

class Format
{
    /**
     * Set ordering of the Class to be migrated.
     * 
     * @var int
     */
    public $ordering = 4;

    /**
     * Run the database seeds with system default records.
     *
     * @param Datasetter $datasetter
     *
     * @return void
     */
    public function data(Datasetter $datasetter): void
    {

        $datasetter->add_data('smsreader', 'format', 'slug', [
            "title" => "Paybill Number",
            "slug" => "paybill_number",
            "format" => '(.*) Confirmed. on (.*) at (.*) (.*) received from (.*) (.*).  Account Number (.*) New Utility balance',
            "fields_str" => 'code, date,time,amount,name,phone,account',
            "action" => 'payment',
            "ordering" => 1,
            "published" => true,
        ]);

        $datasetter->add_data('smsreader', 'format', 'slug', [
            "title" => "Personal Number",
            "slug" => "personal_number",
            "format" => '(.*) Confirmed.You have received (.*) from (.*) (.*) on (.*) at (.*) New M-PESA balance',
            "fields_str" => 'code,amount,name,phone,date,time',
            "action" => 'payment',
            "ordering" => 1,
            "published" => true,
        ]);

        $datasetter->add_data('smsreader', 'format', 'slug', [
            "title" => "Sent to Number Confirmation ",
            "slug" => "sent_number_confirmation",
            "format" => '(.*) Confirmed.(.*) sent to (.*) (.*) on (.*) at (.*). New M-PESA',
            "fields_str" => 'code,amount,name,phone,date,time',
            "action" => 'confirming',
            "ordering" => 1,
            "published" => true,
        ]);

        $datasetter->add_data('smsreader', 'format', 'slug', [
            "title" => "Sent to Pochi Confirmation ",
            "slug" => "sent_pochi_confirmation",
            "format" => '(.*) Confirmed.(.*) sent to (.*) on (.*) at (.*). New M-PESA',
            "fields_str" => 'code,amount,name,date,time',
            "action" => 'confirming',
            "ordering" => 2,
            "published" => true,
        ]);

        $datasetter->add_data('smsreader', 'format', 'slug', [
            "title" => "Sent to TillNo Confirmation ",
            "slug" => "sent_tillno_confirmation",
            "format" => '(.*) Confirmed.(.*) paid to (.*) on (.*) at (.*). New M-PESA',
            "fields_str" => 'code,amount,name,date,time',
            "action" => 'confirming',
            "ordering" => 1,
            "published" => true,
        ]);

        $datasetter->add_data('smsreader', 'format', 'slug', [
            "title" => "Account",
            "slug" => "account_txn",
            "format" => 'ACCOUNT (.*) TXN (.*)',
            "fields_str" => 'account,code',
            "action" => 'account',
            "ordering" => 2,
            "published" => true,
        ]);

        $datasetter->add_data('smsreader', 'format', 'slug', [
            "title" => "Account",
            "slug" => "account",
            "format" => 'ACCOUNT (.*)',
            "fields_str" => 'account',
            "action" => 'account',
            "ordering" => 2,
            "published" => true,
        ]);

    }
}
