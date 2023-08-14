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

        $fields->name('phone')->html('text')->ordering(true);
        $fields->name('code')->html('text')->ordering(true);
        $fields->name('name')->html('text')->ordering(true);
        $fields->name('format_id')->html('recordpicker')->table(['smsreader', 'format'])->ordering(true);
        $fields->name('incoming_id')->html('recordpicker')->table(['smsreader', 'incoming'])->ordering(true);
        $fields->name('partner_id')->html('recordpicker')->table(['partner'])->ordering(true);
        $fields->name('waiting')->html('switch')->ordering(true);
        $fields->name('amount')->html('text')->ordering(true);
        $fields->name('account')->html('text')->ordering(true);
        $fields->name('request_type')->html('text')->ordering(true);
        $fields->name('date_sent')->html('date')->ordering(true);
        $fields->name('completed')->html('switch')->ordering(true);
        $fields->name('successful')->html('switch')->ordering(true);

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

        $fields->name('phone')->html('text')->group('w-1/2');
        $fields->name('code')->html('text')->group('w-1/2');
        $fields->name('name')->html('text')->group('w-1/2');
        $fields->name('format_id')->html('recordpicker')->table(['smsreader', 'format'])->group('w-1/2');
        $fields->name('incoming_id')->html('recordpicker')->table(['smsreader', 'incoming'])->group('w-1/2');
        $fields->name('partner_id')->html('recordpicker')->table(['partner'])->group('w-1/2');
        $fields->name('waiting')->html('switch')->group('w-1/2');
        $fields->name('amount')->html('text')->group('w-1/2');
        $fields->name('account')->html('text')->group('w-1/2');
        $fields->name('request_type')->html('text')->group('w-1/2');
        $fields->name('date_sent')->html('date')->group('w-1/2');
        $fields->name('completed')->html('switch')->group('w-1/2');
        $fields->name('successful')->html('switch')->group('w-1/2');

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

        $fields->name('phone')->html('text')->group('w-1/6');
        $fields->name('code')->html('text')->group('w-1/6');
        $fields->name('name')->html('text')->group('w-1/6');
        $fields->name('format_id')->html('recordpicker')->table(['smsreader', 'format'])->group('w-1/6');
        $fields->name('incoming_id')->html('recordpicker')->table(['smsreader', 'incoming'])->group('w-1/6');
        $fields->name('partner_id')->html('recordpicker')->table(['partner'])->group('w-1/6');
        $fields->name('date_sent')->html('date')->group('w-1/6');
        $fields->name('completed')->html('switch')->group('w-1/6');
        $fields->name('successful')->html('switch')->group('w-1/6');

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
        $this->fields->increments('id');
        $this->fields->char('phone', 255);
        $this->fields->char('code', 255);
        $this->fields->char('name', 255);
        $this->fields->foreignId('format_id');
        $this->fields->foreignId('incoming_id');
        $this->fields->foreignId('partner_id');
        $this->fields->enum('waiting', ['start', 'phone', 'account'])->default('start')->nullable();
        $this->fields->decimal('amount', 20, 2);
        $this->fields->char('account', 255);
        $this->fields->char('request_type', 255);
        $this->fields->datetime('date_sent');
        $this->fields->tinyInteger('completed')->nullable()->default(0);
        $this->fields->tinyInteger('successful')->nullable()->default(0);
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
