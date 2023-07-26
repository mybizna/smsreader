<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;
use Modules\Core\Classes\Views\FormBuilder;
use Modules\Core\Classes\Views\ListTable;

class Incoming extends BaseModel
{

    protected $fillable = ['phone', 'message', 'date_sent', 'params', 'gateway_id', 'is_payment', 'completed', 'successful'];
    public $migrationDependancy = ['sms_gateway'];
    protected $table = "smsreader_incoming";

    protected $can_delete = "false";

    public function listTable()
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('phone')->type('text')->ordering(true);
        $fields->name('message')->type('textarea')->ordering(true);
        $fields->name('date_sent')->type('date')->ordering(true);
        $fields->name('params')->type('text')->ordering(true);
        $fields->name('gateway_id')->type('recordpicker')->table('sms_gateway')->ordering(true);
        $fields->name('is_payment')->type('switch')->ordering(true);
        $fields->name('completed')->type('switch')->ordering(true);
        $fields->name('successful')->type('switch')->ordering(true);

        return $fields;

    }

    public function formBuilder()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('phone')->type('text')->group('w-1/2');
        $fields->name('message')->type('textarea')->group('w-1/2');
        $fields->name('date_sent')->type('date')->group('w-1/2');
        $fields->name('params')->type('text')->group('w-1/2');
        $fields->name('gateway_id')->type('recordpicker')->table('sms_gateway')->group('w-1/2');
        $fields->name('is_payment')->type('switch')->group('w-1/2');
        $fields->name('completed')->type('switch')->group('w-1/2');
        $fields->name('successful')->type('switch')->group('w-1/2');

        return $fields;

    }

    public function filter()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('phone')->type('text')->group('w-1/6');
        $fields->name('date_sent')->type('date')->group('w-1/6');
        $fields->name('gateway_id')->type('recordpicker')->table('sms_gateway')->group('w-1/6');
        $fields->name('is_payment')->type('switch')->group('w-1/6');
        $fields->name('completed')->type('switch')->group('w-1/6');
        $fields->name('successful')->type('switch')->group('w-1/6');

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
        $table->char('phone', 255);
        $table->string('message');
        $table->datetime('date_sent')->nullable();
        $table->datetime('date_received')->nullable();
        $table->string('sim')->nullable();
        $table->foreignId('gateway_id')->nullable();
        $table->string('params')->nullable();
        $table->enum('action', ['payment', 'confirming', 'account', 'withdraw', 'others'])->default('others')->nullable();
        $table->tinyInteger('is_payment')->nullable()->default(0);
        $table->tinyInteger('completed')->nullable()->default(0);
        $table->tinyInteger('successful')->nullable()->default(0);
    }

    public function post_migration(Blueprint $table)
    {
        Migration::addForeign($table, 'sms_gateway', 'gateway_id');
    }

}
