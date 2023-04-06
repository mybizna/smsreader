<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Incoming extends BaseModel
{
  

    protected $fillable = ['phone', 'message', 'date_sent', 'params', 'gateway_id', 'is_payment', 'completed', 'successful'];
    public $migrationDependancy = ['sms_gateway'];
    protected $table = "smsreader_incoming";

    protected $can_delete = "false";

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
        $table->integer('gateway_id')->nullable();
        $table->string('params')->nullable();
        $table->enum('action', ['payment', 'confirming', 'account', 'withdraw', 'others'])->default('others')->nullable();
        $table->tinyInteger('is_payment')->default(false);
        $table->tinyInteger('completed')->default(false);
        $table->tinyInteger('successful')->default(false);
    }

    public function post_migration(Blueprint $table)
    {
        if (Migration::checkKeyExist('smsreader_incoming', 'gateway_id')) {
            $table->foreign('gateway_id')->references('id')->on('sms_gateway')->nullOnDelete();
        }
    }

}