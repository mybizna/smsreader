<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;
use Modules\Base\Classes\Views\FormBuilder;
use Modules\Base\Classes\Views\ListTable;

class Account extends BaseModel
{
    /**
     * The fields that can be filled
     * @var array<string>
     */
    protected $fillable = ['partner_id', 'txn', 'account'];

    /**
     * List of tables names that are need in this model during migration.
     * @var array<string>
     */
    public array $migrationDependancy = ['partner'];

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = "smsreader_account";

    public function  listTable(): ListTable
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

    public function filter(): FormBuilder
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('partner_id')->type('recordpicker')->table('partner')->group('w-1/6');
        $fields->name('txn')->type('text')->group('w-1/6');
        $fields->name('account')->type('text')->group('w-1/6');

        return $fields;

    }
    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
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
