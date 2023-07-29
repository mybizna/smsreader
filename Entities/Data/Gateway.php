<?php

namespace Modules\Smsreader\Entities\Data;

use Illuminate\Support\Facades\DB;
use Modules\Base\Classes\Datasetter;

class Gateway
{
    /**
     * Set ordering of the Class to be migrated.
     * @var int
     */
    public $ordering = 7;

    /**
     * Run the database seeds with system default records.
     *
     * @param Datasetter $datasetter
     *
     * @return void
     */
    public function data(Datasetter $datasetter): void
    {
        $ledger_id = DB::table('account_ledger')->where('slug', 'smsreader')->value('id');
        $currency_id = DB::table('core_currency')->where('code', 'KES')->value('id');

        $datasetter->add_data('account', 'gateway', 'slug', [
            "title" => "Smsreader",
            "slug" => "smsreader",
            "ledger_id" => $ledger_id,
            "currency_id" => $currency_id,
            "instruction" => "Please send to Phone Number 0722XXXXXX and enter the MPesa Code in field below.",
            "module" => "Smsreader",
            "ordering" => 5,
            "is_default" => false,
            "is_hidden" => false,
            "published" => true,
        ]);

    }
}
