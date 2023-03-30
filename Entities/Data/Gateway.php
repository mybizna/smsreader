<?php

namespace Modules\Smsreader\Entities\Data;

use Illuminate\Support\Facades\DB;
use Modules\Base\Classes\Datasetter;

class Gateway
{

    public $ordering = 7;

    public function data(Datasetter $datasetter)
    {
        $ledger_id = DB::table('account_ledger')->where('slug', 'smsreader')->value('id');
        
        $datasetter->add_data('account', 'gateway', 'slug', [
            "title" => "Smsreader",
            "slug" => "smsreader",
            "ledger_id" => $ledger_id,
            "instruction" => "Send Money to:",
            "module" => "Smsreader",
            "ordering" => 0,
            "is_default" => false,
            "is_hidden" => false,
            "published" => true
        ]);
        
    

    }
}
