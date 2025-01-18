<?php

namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;
use Illuminate\Database\Schema\Blueprint;

class Template extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['title', 'slug', 'template', 'published'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_template";


    public function migration(Blueprint $table): void
    {


        $table->char('title', 255);
        $table->char('slug', 255);
        $table->string('template');
        $table->tinyInteger('published')->default(1);

    }
}
