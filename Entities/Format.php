<?php

namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;

class Format extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['title', 'slug', 'format', 'fields_str', 'published'];

    /**
     * The table associated with the modelc string
     */
    protected $table = "smsreader_format";

}
