<?php

namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;

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

}
