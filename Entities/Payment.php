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
    protected bool $can_delete = false;

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $waiting = ['start', 'phone', 'account'];

        $this->fields->increments('id')->html('hidden');
        $this->fields->char('phone', 255)->html('text');
        $this->fields->char('code', 255)->html('text');
        $this->fields->char('name', 255)->html('text');
        $this->fields->foreignId('format_id')->html('recordpicker')->relation(['smsreader', 'format']);
        $this->fields->foreignId('incoming_id')->html('recordpicker')->relation(['smsreader', 'incoming']);
        $this->fields->foreignId('partner_id')->html('recordpicker')->relation(['partner']);
        $this->fields->enum('waiting', $waiting)->options($waiting)->default('start')->nullable()->html('select');
        $this->fields->decimal('amount', 20, 2)->html('amount');
        $this->fields->char('account', 255)->html('text');
        $this->fields->char('request_type', 255)->html('text');
        $this->fields->datetime('date_sent')->html('date');
        $this->fields->tinyInteger('completed')->nullable()->default(0)->html('switch');
        $this->fields->tinyInteger('successful')->nullable()->default(0)->html('switch');
    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {

        $structure['table'] = ['phone', 'code', 'name', 'format_id', 'incoming_id', 'partner_id', 'amount', 'account', 'date_sent', 'completed', 'successful'];
        $structure['form'] = [
            ['label' => 'Name', 'class' => 'col-span-full', 'fields' => ['name']],
            ['label' => 'Published', 'class' => 'col-span-6', 'fields' => ['phone', 'code', 'format_id', 'incoming_id', 'partner_id']],
            ['label' => 'Published', 'class' => 'col-span-6', 'fields' => ['amount', 'account', 'date_sent', 'completed', 'successful']],
        ];
        $structure['filter'] = ['phone', 'format_id', 'incoming_id', 'partner_id', 'amount'];

        return $structure;
    }

}
