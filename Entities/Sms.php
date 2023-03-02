<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;
use Modules\Base\Classes\Migration;

class Sms extends BaseModel
{

    protected $fillable = ['phone', 'message', 'params', 'gateway_id', 'completed', 'successful'];
    public $migrationDependancy = ['sms_gateway'];
    protected $table = "smsreader_sms";

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
        $table->string('params');
        $table->integer('gateway_id');
        $table->tinyInteger('completed')->default(false);
        $table->tinyInteger('successful')->default(false);
    }

    public function post_migration(Blueprint $table)
    {
        if (Migration::checkKeyExist('smsreader_sms', 'gateway_id')) {
            $table->foreign('gateway_id')->references('id')->on('sms_gateway')->nullOnDelete();
        }
    }

}
