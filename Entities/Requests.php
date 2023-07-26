<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

use Modules\Core\Classes\Views\ListTable;
use Modules\Core\Classes\Views\FormBuilder;

class Requests extends BaseModel
{

    protected $fillable = ['payment_id', 'phone', 'message', 'date_sent'];
    public $migrationDependancy = ['smsreader_template'];
    protected $table = "smsreader_requests";


    public function listTable(){
        // listing view fields
        $fields = new ListTable();

        $fields->name('payment_id')->type('text')->ordering(true);
        $fields->name('phone')->type('text')->ordering(true);
        $fields->name('message')->type('textarea')->ordering(true);
        $fields->name('date_sent')->type('date')->ordering(true);

        return $fields;

    }
    
    public function formBuilder(){
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('payment_id')->type('text')->group('w-1/2');
        $fields->name('phone')->type('text')->group('w-1/2');
        $fields->name('message')->type('textarea')->group('w-1/2');
        $fields->name('date_sent')->type('date')->group('w-1/2');

        return $fields;

    }

    public function filter(){
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('payment_id')->type('text')->group('w-1/6');
        $fields->name('phone')->type('text')->group('w-1/6');
        $fields->name('message')->type('textarea')->group('w-1/6');
        $fields->name('date_sent')->type('date')->group('w-1/6');

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
        $table->foreignId('payment_id');
        $table->char('phone', 255);
        $table->char('slug_str', 255);
        $table->string('message');
        $table->datetime('date_sent');
    }

    public function post_migration(Blueprint $table)
    {
        Migration::addForeign($table, 'smsreader_payment', 'payment_id');
    }

}
