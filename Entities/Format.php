<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Classes\Views\FormBuilder;
use Modules\Base\Classes\Views\ListTable;
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
     * Function for defining list of fields in table view.
     *
     * @return ListTable
     */
    public function listTable(): ListTable
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('title')->html('text')->ordering(true);
        $fields->name('slug')->html('text')->ordering(true);
        $fields->name('format')->html('text')->ordering(true);
        $fields->name('fields_str')->html('text')->ordering(true);
        $fields->name('published')->html('switch')->ordering(true);

        return $fields;

    }

    /**
     * Function for defining list of fields in form view.
     *
     * @return FormBuilder
     */
    public function formBuilder(): FormBuilder
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('title')->html('text')->group('w-1/2');
        $fields->name('slug')->html('text')->group('w-1/2');
        $fields->name('format')->html('text')->group('w-1/2');
        $fields->name('fields_str')->html('text')->group('w-1/2');
        $fields->name('published')->html('switch')->group('w-1/2');

        return $fields;

    }

    /**
     * Function for defining list of fields in filter view.
     *
     * @return FormBuilder
     */
    public function filter(): FormBuilder
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('title')->html('text')->group('w-1/6');
        $fields->name('slug')->html('text')->group('w-1/6');
        $fields->name('format')->html('text')->group('w-1/6');
        $fields->name('fields_str')->html('text')->group('w-1/6');
        $fields->name('published')->html('switch')->group('w-1/6');

        return $fields;

    }
    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table): void
    {
        $this->fields->increments('id');
        $this->fields->char('title', 255);
        $this->fields->char('slug', 255);
        $this->fields->string('format');
        $this->fields->string('fields_str');
        $this->fields->enum('action', ['payment', 'confirming', 'account', 'withdraw', 'others'])->default('others')->nullable();
        $this->fields->integer('ordering')->default(5);
        $this->fields->tinyInteger('published')->default(true);
    }
}
