<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;
use Modules\Core\Classes\Views\FormBuilder;
use Modules\Core\Classes\Views\ListTable;

class Format extends BaseModel
{

    protected $fillable = ['title', 'slug', 'format', 'fields_str', 'published'];
    public $migrationDependancy = [];
    protected $table = "smsreader_format";

    public function listTable()
    {
        // listing view fields
        $fields = new ListTable();

        $fields->name('title')->type('text')->ordering(true);
        $fields->name('slug')->type('text')->ordering(true);
        $fields->name('format')->type('text')->ordering(true);
        $fields->name('fields_str')->type('text')->ordering(true);
        $fields->name('published')->type('switch')->ordering(true);

        return $fields;

    }

    public function formBuilder()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('title')->type('text')->group('w-1/2');
        $fields->name('slug')->type('text')->group('w-1/2');
        $fields->name('format')->type('text')->group('w-1/2');
        $fields->name('fields_str')->type('text')->group('w-1/2');
        $fields->name('published')->type('switch')->group('w-1/2');

        return $fields;

    }

    public function filter()
    {
        // listing view fields
        $fields = new FormBuilder();

        $fields->name('title')->type('text')->group('w-1/6');
        $fields->name('slug')->type('text')->group('w-1/6');
        $fields->name('format')->type('text')->group('w-1/6');
        $fields->name('fields_str')->type('text')->group('w-1/6');
        $fields->name('published')->type('switch')->group('w-1/6');

        return $fields;

    }
    /**
     * List of fields for managing postings.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table)
    {
        $table->increments('id');
        $table->char('title', 255);
        $table->char('slug', 255);
        $table->string('format');
        $table->string('fields_str');
        $table->enum('action', ['payment', 'confirming', 'account', 'withdraw', 'others'])->default('others')->nullable();
        $table->integer('ordering')->default(5);
        $table->tinyInteger('published')->default(true);
    }
}
