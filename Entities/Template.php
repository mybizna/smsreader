<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Template extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['title', 'slug', 'template', 'published'];

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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_template";

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
        $this->fields->char('title', 255)->html('text');
        $this->fields->char('slug', 255)->html('text');
        $this->fields->string('template')->html('text');
        $this->fields->tinyInteger('published')->default(true)->html('switch');
    }

    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure = [
            'table' => ['title', 'slug', 'published'],
            'form' => [
                ['label' => 'Title', 'class' => 'w-full', 'fields' => ['title', 'slug']],
                ['label' => 'Published', 'class' => 'w-1/2', 'fields' => ['published']],
                ['label' => 'Template', 'class' => 'w-full', 'fields' => ['template']],
            ],
            'filter' => ['title', 'slug', 'published'],
        ];

        return $structure;
    }
}
