<?php

namespace Modules\Smsreader\Entities;

use Modules\Base\Entities\BaseModel;

class Whitelist extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['sender'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_whitelist";

}
