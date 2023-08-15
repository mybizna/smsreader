<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Payment extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['phone', 'code', 'name', 'format_id', 'incoming_id', 'partner_id',
        'amount', 'account', 'date_sent', 'completed', 'successful'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['partner_id', 'account'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = ['smsreader_format', 'smsreader_incoming', 'partner'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_payment";

    /**
     * Determine if the model should be deleted.
     *
     * @var bool
     */
    protected $can_delete = false;

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table): void
    {
        $this->fields = $table ?? new Blueprint($this->table);
        
        $this->fields->increments('id')->html('text');
        $this->fields->char('phone', 255)->html('text');
        $this->fields->char('code', 255)->html('text');
        $this->fields->char('name', 255)->html('text');
        $this->fields->foreignId('format_id')->html('recordpicker')->table(['smsreader', 'format']);
        $this->fields->foreignId('incoming_id')->html('recordpicker')->table(['smsreader', 'incoming']);
        $this->fields->foreignId('partner_id')->html('recordpicker')->table(['partner']);
        $this->fields->enum('waiting', ['start', 'phone', 'account'])->default('start')->nullable()->html('select');
        $this->fields->decimal('amount', 20, 2)->html('amount');
        $this->fields->char('account', 255)->html('text');
        $this->fields->char('request_type', 255)->html('text');
        $this->fields->datetime('date_sent')->html('date');
        $this->fields->tinyInteger('completed')->nullable()->default(0)->html('switch');
        $this->fields->tinyInteger('successful')->nullable()->default(0)->html('switch');
    }

}
