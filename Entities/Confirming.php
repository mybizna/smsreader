<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Migration;
use Modules\Base\Entities\BaseModel;

class Confirming extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['phone', 'code', 'name', 'format_id', 'incoming_id',
        'amount', 'account', 'date_sent', 'completed', 'successful'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['phone', 'amount'];

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
    protected $table = "smsreader_confirming";

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

        $this->fields->increments('id')->html('hidden');
        $this->fields->char('phone', 255)->html('text');
        $this->fields->char('code', 255)->html('text');
        $this->fields->char('name', 255)->html('text');
        $this->fields->datetime('date_sent')->html('date');
        $this->fields->foreignId('format_id')->nullable()->html('recordpicker')->relation(['smsreader', 'format']);
        $this->fields->foreignId('incoming_id')->nullable()->html('recordpicker')->relation(['smsreader', 'incoming']);
        $this->fields->decimal('amount', 20, 2)->nullable()->html('amount');
        $this->fields->char('account', 255)->nullable()->html('text');
        $this->fields->tinyInteger('completed')->nullable()->default(0)->html('switch');
        $this->fields->tinyInteger('successful')->nullable()->default(0)->html('switch');
    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {

        $structure['table'] = ['phone', 'code', 'name', 'format_id', 'incoming_id', 'amount', 'account', 'date_sent', 'completed', 'successful'];
        $structure['form'] = [
            ['label' => 'Confirming Code', 'class' => 'col-span-full', 'fields' => ['code']],
            ['label' => 'Confirming Detail', 'class' => 'col-span-full  md:col-span-6 md:pr-2', 'fields' => ['format_id', 'incoming_id', 'amount', 'account']],
            ['label' => 'Confirming Published', 'class' => 'col-span-full  md:col-span-6 md:pr-2', 'fields' => ['date_sent', 'completed', 'successful']],
        ];
        $structure['filter'] = ['phone', 'code', 'name', 'format_id', 'incoming_id'];

        return $structure;
    }

    /**
     * Define rights for this model.
     *
     * @return array
     */
    public function rights(): array
    {
        $rights = parent::rights();

        $rights['staff'] = ['view' => true];
        $rights['registered'] = ['view' => true];
        $rights['guest'] = [];

        return $rights;
    }

}
