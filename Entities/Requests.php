<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Classes\Views\FormBuilder;
use Modules\Base\Classes\Views\ListTable;
use Modules\Base\Entities\BaseModel;

class Requests extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['payment_id', 'phone', 'message', 'date_sent'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['payment_id', 'phone'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = ['smsreader_template'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_requests";

    /**
     * Function for defining list of fields in table view.
     *
     * @return ListTable
     */

    public function listTable(): ListTable
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('payment_id')->html('text')->ordering(true);
        $fields->name('phone')->html('text')->ordering(true);
        $fields->name('message')->html('textarea')->ordering(true);
        $fields->name('date_sent')->html('date')->ordering(true);

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

        $fields->name('payment_id')->html('text')->group('w-1/2');
        $fields->name('phone')->html('text')->group('w-1/2');
        $fields->name('message')->html('textarea')->group('w-1/2');
        $fields->name('date_sent')->html('date')->group('w-1/2');

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

        $fields->name('payment_id')->html('text')->group('w-1/6');
        $fields->name('phone')->html('text')->group('w-1/6');
        $fields->name('message')->html('textarea')->group('w-1/6');
        $fields->name('date_sent')->html('date')->group('w-1/6');

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
        $this->fields->foreignId('payment_id');
        $this->fields->char('phone', 255);
        $this->fields->char('slug_str', 255);
        $this->fields->string('message');
        $this->fields->datetime('date_sent');
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
        Migration::addForeign($table, 'smsreader_payment', 'payment_id');
    }

}
