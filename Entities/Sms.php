<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Sms extends BaseModel
{

    protected $fillable = ['name'];
    public $migrationDependancy = ['sms_gateway'];
    protected $table = "smsreader_sms";

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
        $table->datetime('date_sent');
        $table->string('params');
        $table->integer('gateway_id');
        $table->tinyInteger('completed')->default(true);
        $table->tinyInteger('successful')->default(true);
    }

    public function post_migration(Blueprint $table)
    {
        if (Migration::checkKeyExist('smsreader_sms', 'gateway_id')) {
            $table->foreign('gateway_id')->references('id')->on('sms_gateway')->nullOnDelete();
        }
    }

}
