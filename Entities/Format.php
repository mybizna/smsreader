<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Format extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['title', 'slug', 'format', 'fields_str', 'published'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['title'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = [];

    /**
     * The table associated with the modelc string
     */
    protected $table = "smsreader_format";

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
        $this->fields->char('title', 255)->html('text');
        $this->fields->char('slug', 255)->html('text');
        $this->fields->string('format')->html('text');
        $this->fields->string('fields_str')->html('text');
        $this->fields->enum('action', $action)->options($actions)->default('others')->nullable()->html('select');
        $this->fields->integer('ordering')->default(5)->html('number');
        $this->fields->tinyInteger('published')->default(true)->html('switch');
    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure = [
            'table' => ['title', 'slug', 'format', 'fields_str', 'published'],
            'filter' => ['title', 'slug', 'published'],
        ];

        return $structure;
    }
}
