<?php

namespace Modules\Smsreader\Entities;

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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_template";

}
