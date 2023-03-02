<?php

namespace Modules\Smsreader\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Template extends BaseModel
{

    protected $fillable = ['title','slug', 'template', 'published'];
    public $migrationDependancy = [];
    protected $table = "smsreader_template";

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
        $table->string('template');
        $table->tinyInteger('published')->default(true);
    }
}
