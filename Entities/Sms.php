<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Sms extends BaseModel
{
    /**
     * Modules\Smsreader\Entities\Sms::create(['phone'=>'254732329393','date_sent'=>date('Y-m-d H:i:s'),'gateway_id' => 1, 'message'=>'PD77K63BLBX Confirmed. on 12/11/09 at 5:34 AM Ksh100 received from Maina Ben Account Number 123ABC New Utility balance is Ksh3,150',]);
     */

    protected $fillable = ['phone', 'message', 'date_sent', 'params', 'gateway_id', 'is_payment', 'completed', 'successful'];
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
        $table->datetime('date_sent');
        $table->integer('gateway_id');
        $table->string('params')->nullable();
        $table->tinyInteger('is_payment')->default(false);
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
