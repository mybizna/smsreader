<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Requests extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['payment_id', 'phone', 'message', 'date_sent'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['payment_id', 'phone'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = ['smsreader_template'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_requests";

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);
        
        $this->fields->increments('id')->html('text');
        $this->fields->foreignId('payment_id')->html('recordpicker')->relation(['smsreader', 'payment']);
        $this->fields->char('phone', 255)->html('text');
        $this->fields->char('slug_str', 255)->html('text');
        $this->fields->string('message')->html('textarea');
        $this->fields->datetime('date_sent')->html('date');
    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        
        $structure = [
            'table' => ['payment_id', 'phone', 'message', 'date_sent'],
            'form' => [
                ['label' => 'Phone', 'class' => 'w-full', 'fields' => ['phone']],
                ['label' => 'Request', 'class' => 'w-1/2', 'fields' => ['payment_id',  'date_sent']],
                ['label' => 'Message', 'class' => 'w-full', 'fields' => ['message']],
            ],
            'filter' => ['payment_id', 'phone', 'date_sent'],
        ];

        return $structure;
    }

}
