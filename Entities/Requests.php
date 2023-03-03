<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Requests extends BaseModel
{

    protected $fillable = ['payment_id', 'phone', 'message', 'date_sent'];
    public $migrationDependancy = ['smsreader_template'];
    protected $table = "smsreader_requests";

    /**
     * List of fields for managing postings.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table)
    {
        $table->increments('id');
        $table->integer('payment_id');
        $table->char('phone', 255);
        $table->char('slug_str', 255);
        $table->string('message');
        $table->datetime('date_sent');
    }

    public function post_migration(Blueprint $table)
    {
        if (Migration::checkKeyExist('smsreader_requests', 'payment_id')) {
            $table->foreign('payment_id')->references('id')->on('smsreader_payment')->nullOnDelete();
        }
    }

}
