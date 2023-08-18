<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Incoming extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['phone', 'message', 'date_sent', 'params', 'gateway_id', 'is_payment', 'completed', 'successful'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['phone'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = ['sms_gateway'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_incoming";

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
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $actions = ['payment', 'confirming', 'account', 'withdraw', 'others'];

        $this->fields->increments('id')->html('text');
        $this->fields->char('phone', 255)->html('text');
        $this->fields->string('message')->html('textarea');
        $this->fields->datetime('date_sent')->nullable()->html('date');
        $this->fields->datetime('date_received')->nullable()->html('date');
        $this->fields->string('sim')->nullable()->html('text');
        $this->fields->foreignId('gateway_id')->nullable()->html('recordpicker')->relation(['sms', 'gateway']);
        $this->fields->string('params')->nullable()->html('textarea');
        $this->fields->enum('action', $actions)->options($actions)->default('others')->nullable()->html('select');
        $this->fields->tinyInteger('is_payment')->nullable()->default(0)->html('switch');
        $this->fields->tinyInteger('completed')->nullable()->default(0)->html('switch');
        $this->fields->tinyInteger('successful')->nullable()->default(0)->html('switch');
    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['phone', 'message', 'date_sent', 'gateway_id', 'is_payment', 'completed', 'successful'];
        $structure['form'] = [
            ['label' => 'Phone', 'class' => 'col-span-full', 'fields' => ['phone']],
            ['label' => 'Message', 'class' => 'col-span-full', 'fields' => ['message']],
            ['label' => 'Incoming', 'class' => 'col-span-6', 'fields' => ['date_sent', 'params', 'gateway_id']],
            ['label' => 'Incoming', 'class' => 'col-span-6', 'fields' => ['is_payment', 'completed', 'successful']],
        ];
        $structure['filter'] = ['phone', 'date_sent', 'gateway_id', 'is_payment', 'completed', 'successful'];

        return $structure;
    }

}
