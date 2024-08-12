<?php
namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;

class Blacklist extends BaseModel
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
    protected $table = "smsreader_blacklist";

}
