<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Payment extends BaseModel
{

    protected $fillable = ['phone', 'code', 'name', 'format_id', 'incoming_id', 'partner_id',
        'amount', 'account', 'date_sent', 'completed', 'successful'];
    public $migrationDependancy = ['smsreader_format', 'smsreader_incoming', 'partner'];
    protected $table = "smsreader_payment";

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
        $table->char('code', 255);
        $table->char('name', 255);
        $table->foreignId('format_id');
        $table->foreignId('incoming_id');
        $table->foreignId('partner_id');
        $table->enum('waiting', ['start', 'phone', 'account'])->default('start')->nullable();
        $table->decimal('amount', 20, 2);
        $table->char('account', 255);
        $table->char('request_type', 255);
        $table->datetime('date_sent');
        $table->tinyInteger('completed')->default(false);
        $table->tinyInteger('successful')->default(false);
    }

    public function post_migration(Blueprint $table)
    {
        Migration::addForeign($table, 'smsreader_format', 'format_id');
        Migration::addForeign($table, 'smsreader_incoming', 'incoming_id');
        Migration::addForeign($table, 'partner', 'partner_id');
    }
}
