<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;
use Modules\Base\Classes\Migration;

class Payment extends BaseModel
{

    protected $fillable = ['phone', 'code', 'name', 'format_id', 'sms_id', 'partner_id',
        'amount', 'account', 'date_sent', 'completed', 'successful'];
    public $migrationDependancy = ['smsreader_format', 'smsreader_sms', 'partner'];
    protected $table = "smsreader_payment";

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
        $table->integer('format_id');
        $table->integer('sms_id');
        $table->integer('partner_id');
        $table->decimal('amount', 20, 2);
        $table->char('account', 255);
        $table->datetime('date_sent');
        $table->tinyInteger('completed')->default(false);
        $table->tinyInteger('successful')->default(false);
    }

    public function post_migration(Blueprint $table)
    {
        if (Migration::checkKeyExist('smsreader_payment', 'format_id')) {
            $table->foreign('format_id')->references('id')->on('smsreader_format')->nullOnDelete();
        }

        if (Migration::checkKeyExist('smsreader_payment', 'message_id')) {
            $table->foreign('message_id')->references('id')->on('smsreader_sms')->nullOnDelete();
        }

        if (Migration::checkKeyExist('smsreader_payment', 'partner_id')) {
            $table->foreign('partner_id')->references('id')->on('partner')->nullOnDelete();
        }
    }
}
