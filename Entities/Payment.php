<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Classes\Views\FormBuilder;
use Modules\Base\Classes\Views\ListTable;
use Modules\Base\Entities\BaseModel;

class Payment extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['phone', 'code', 'name', 'format_id', 'incoming_id', 'partner_id',
        'amount', 'account', 'date_sent', 'completed', 'successful'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['partner_id', 'account'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = ['smsreader_format', 'smsreader_incoming', 'partner'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_payment";

    /**
     * Determine if the model should be deleted.
     *
     * @var bool
     */
    protected $can_delete = false;

    /**
     * Function for defining list of fields in table view.
     *
     * @return ListTable
     */
    public function listTable(): ListTable
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('phone')->type('text')->ordering(true);
        $fields->name('code')->type('text')->ordering(true);
        $fields->name('name')->type('text')->ordering(true);
        $fields->name('format_id')->type('recordpicker')->table(['smsreader', 'format'])->ordering(true);
        $fields->name('incoming_id')->type('recordpicker')->table(['smsreader', 'incoming'])->ordering(true);
        $fields->name('partner_id')->type('recordpicker')->table(['partner'])->ordering(true);
        $fields->name('waiting')->type('switch')->ordering(true);
        $fields->name('amount')->type('text')->ordering(true);
        $fields->name('account')->type('text')->ordering(true);
        $fields->name('request_type')->type('text')->ordering(true);
        $fields->name('date_sent')->type('date')->ordering(true);
        $fields->name('completed')->type('switch')->ordering(true);
        $fields->name('successful')->type('switch')->ordering(true);

        return $fields;

    }

    /**
     * Function for defining list of fields in form view.
     *
     * @return FormBuilder
     */
    public function formBuilder(): FormBuilder
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('phone')->type('text')->group('w-1/2');
        $fields->name('code')->type('text')->group('w-1/2');
        $fields->name('name')->type('text')->group('w-1/2');
        $fields->name('format_id')->type('recordpicker')->table(['smsreader', 'format'])->group('w-1/2');
        $fields->name('incoming_id')->type('recordpicker')->table(['smsreader', 'incoming'])->group('w-1/2');
        $fields->name('partner_id')->type('recordpicker')->table(['partner'])->group('w-1/2');
        $fields->name('waiting')->type('switch')->group('w-1/2');
        $fields->name('amount')->type('text')->group('w-1/2');
        $fields->name('account')->type('text')->group('w-1/2');
        $fields->name('request_type')->type('text')->group('w-1/2');
        $fields->name('date_sent')->type('date')->group('w-1/2');
        $fields->name('completed')->type('switch')->group('w-1/2');
        $fields->name('successful')->type('switch')->group('w-1/2');

        return $fields;

    }

    /**
     * Function for defining list of fields in filter view.
     *
     * @return FormBuilder
     */
    public function filter(): FormBuilder
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('phone')->type('text')->group('w-1/6');
        $fields->name('code')->type('text')->group('w-1/6');
        $fields->name('name')->type('text')->group('w-1/6');
        $fields->name('format_id')->type('recordpicker')->table(['smsreader', 'format'])->group('w-1/6');
        $fields->name('incoming_id')->type('recordpicker')->table(['smsreader', 'incoming'])->group('w-1/6');
        $fields->name('partner_id')->type('recordpicker')->table(['partner'])->group('w-1/6');
        $fields->name('date_sent')->type('date')->group('w-1/6');
        $fields->name('completed')->type('switch')->group('w-1/6');
        $fields->name('successful')->type('switch')->group('w-1/6');

        return $fields;

    }
    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table): void
    {
        $table->increments('id');
        $table->char('phone', 255);
        $table->char('code', 255);
        $table->char('name', 255);
        $table->foreignId('format_id');
        $table->foreignId('incoming_id');
        $table->foreignId('partner_id');
        $table->enum('waiting', ['start', 'phone', 'account'])->default('start')->nullable();
        $table->decimal('amount', 20, 2);
        $table->char('account', 255);
        $table->char('request_type', 255);
        $table->datetime('date_sent');
        $table->tinyInteger('completed')->nullable()->default(0);
        $table->tinyInteger('successful')->nullable()->default(0);
    }

    /**
     * Handle post migration processes for adding foreign keys.
     *
     * @param Blueprint $table
     *
     * @return void
     */
    public function post_migration(Blueprint $table): void
    {
        Migration::addForeign($table, 'smsreader_format', 'format_id');
        Migration::addForeign($table, 'smsreader_incoming', 'incoming_id');
        Migration::addForeign($table, 'partner', 'partner_id');
    }
}
