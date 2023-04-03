<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Format extends BaseModel
{

    protected $fillable = ['title','slug', 'format', 'fields_str', 'published'];
    public $migrationDependancy = [];
    protected $table = "smsreader_format";

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
