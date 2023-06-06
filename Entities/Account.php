<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Account extends BaseModel
{

    protected $fillable = ['partner_id', 'txn', 'account'];
    public $migrationDependancy = [];
    protected $table = "smsreader_account";

    /**
     * List of fields for managing postings.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table)
    {
        $table->increments('id');
        $table->foreignId('partner_id');
        $table->char('account', 255);
        $table->char('txn', 255);
    }
    public function post_migration(Blueprint $table)
    {
        Migration::addForeign($table, 'partner', 'partner_id');
    }
}
