<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;
use Modules\Core\Classes\Views\FormBuilder;
use Modules\Core\Classes\Views\ListTable;

class Confirming extends BaseModel
{

    protected $fillable = ['phone', 'code', 'name', 'format_id', 'incoming_id',
        'amount', 'account', 'date_sent', 'completed', 'successful'];
    public $migrationDependancy = ['smsreader_format', 'smsreader_incoming', 'partner'];
    protected $table = "smsreader_confirming";

    protected $can_delete = "false";

    public function listTable()
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('phone')->type('text')->ordering(true);
        $fields->name('code')->type('text')->ordering(true);
        $fields->name('name')->type('text')->ordering(true);
        $fields->name('format_id')->type('recordpicker')->table('smsreader_format')->ordering(true);
        $fields->name('incoming_id')->type('recordpicker')->table('smsreader_incoming')->ordering(true);
        $fields->name('amount')->type('text')->ordering(true);
        $fields->name('account')->type('text')->ordering(true);
        $fields->name('request_type')->type('text')->ordering(true);
        $fields->name('date_sent')->type('date')->ordering(true);
        $fields->name('completed')->type('switch')->ordering(true);
        $fields->name('successful')->type('switch')->ordering(true);

        return $fields;

    }

    public function formBuilder()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('phone')->type('text')->group('w-1/2');
        $fields->name('code')->type('text')->group('w-1/2');
        $fields->name('name')->type('text')->group('w-1/2');
        $fields->name('format_id')->type('recordpicker')->table('smsreader_format')->group('w-1/2');
        $fields->name('incoming_id')->type('recordpicker')->table('smsreader_incoming')->group('w-1/2');
        $fields->name('amount')->type('text')->group('w-1/2');
        $fields->name('account')->type('text')->group('w-1/2');
        $fields->name('request_type')->type('text')->group('w-1/2');
        $fields->name('date_sent')->type('date')->group('w-1/2');
        $fields->name('completed')->type('switch')->group('w-1/2');
        $fields->name('successful')->type('switch')->group('w-1/2');

        return $fields;

    }

    public function filter()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('phone')->type('text')->group('w-1/6');
        $fields->name('code')->type('text')->group('w-1/6');
        $fields->name('name')->type('text')->group('w-1/6');
        $fields->name('format_id')->type('recordpicker')->table('smsreader_format')->group('w-1/6');
        $fields->name('incoming_id')->type('recordpicker')->table('smsreader_incoming')->group('w-1/6');
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
        $table->char('code', 255);
        $table->char('name', 255);
        $table->datetime('date_sent');
        $table->foreignId('format_id')->nullable();
        $table->foreignId('incoming_id')->nullable();
        $table->decimal('amount', 20, 2)->nullable();
        $table->char('account', 255)->nullable();
        $table->tinyInteger('completed')->nullable()->default(0);
        $table->tinyInteger('successful')->nullable()->default(0);
    }

    public function post_migration(Blueprint $table)
    {
        Migration::addForeign($table, 'smsreader_format', 'format_id');
        Migration::addForeign($table, 'smsreader_incoming', 'incoming_id');
    }
}
