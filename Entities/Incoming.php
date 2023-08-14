<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Classes\Views\FormBuilder;
use Modules\Base\Classes\Views\ListTable;
use Modules\Base\Entities\BaseModel;

class Incoming extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['phone', 'message', 'date_sent', 'params', 'gateway_id', 'is_payment', 'completed', 'successful'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['phone'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = ['sms_gateway'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_incoming";

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
        $fields->name('message')->html('textarea')->ordering(true);
        $fields->name('date_sent')->html('date')->ordering(true);
        $fields->name('params')->html('text')->ordering(true);
        $fields->name('gateway_id')->html('recordpicker')->table(['sms', 'gateway'])->ordering(true);
        $fields->name('is_payment')->html('switch')->ordering(true);
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
        $fields->name('message')->html('textarea')->group('w-1/2');
        $fields->name('date_sent')->html('date')->group('w-1/2');
        $fields->name('params')->html('text')->group('w-1/2');
        $fields->name('gateway_id')->html('recordpicker')->table(['sms', 'gateway'])->group('w-1/2');
        $fields->name('is_payment')->html('switch')->group('w-1/2');
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
        $fields->name('date_sent')->html('date')->group('w-1/6');
        $fields->name('gateway_id')->html('recordpicker')->table(['sms', 'gateway'])->group('w-1/6');
        $fields->name('is_payment')->html('switch')->group('w-1/6');
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
        $this->fields->string('message');
        $this->fields->datetime('date_sent')->nullable();
        $this->fields->datetime('date_received')->nullable();
        $this->fields->string('sim')->nullable();
        $this->fields->foreignId('gateway_id')->nullable();
        $this->fields->string('params')->nullable();
        $this->fields->enum('action', ['payment', 'confirming', 'account', 'withdraw', 'others'])->default('others')->nullable();
        $this->fields->tinyInteger('is_payment')->nullable()->default(0);
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
        Migration::addForeign($table, 'sms_gateway', 'gateway_id');
    }

}
