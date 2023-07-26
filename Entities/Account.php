<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;
use Modules\Core\Classes\Views\FormBuilder;
use Modules\Core\Classes\Views\ListTable;

class Account extends BaseModel
{

    protected $fillable = ['partner_id', 'txn', 'account'];
    public $migrationDependancy = ['partner'];
    protected $table = "smsreader_account";

    public function listTable()
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('partner_id')->type('recordpicker')->table('partner')->ordering(true);
        $fields->name('txn')->type('text')->ordering(true);
        $fields->name('account')->type('text')->ordering(true);

        return $fields;

    }

    public function formBuilder()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('partner_id')->type('recordpicker')->table('partner')->group('w-1/2');
        $fields->name('txn')->type('text')->group('w-1/2');
        $fields->name('account')->type('text')->group('w-1/2');

        return $fields;

    }

    public function filter()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('partner_id')->type('recordpicker')->table('partner')->group('w-1/6');
        $fields->name('txn')->type('text')->group('w-1/6');
        $fields->name('account')->type('text')->group('w-1/6');

        return $fields;

    }
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
