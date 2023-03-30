<?php

namespace Modules\Smsreader\Entities\Data;

use Illuminate\Support\Facades\DB;
use Modules\Base\Classes\Datasetter;

class Ledger
{

    public $ordering = 5;

    public function data(Datasetter $datasetter)
    {
        $asset_chart_id = DB::table('account_chart_of_account')
            ->where('slug', 'asset')->value('id');

        $datasetter->add_data('account', 'ledger', 'slug', [
            "chart_id" => $asset_chart_id,
            "name" => "Smsreader",
            "slug" => "smsreader",
            "code" => "94",
            "system" => "0",
        ]);

    }
}
