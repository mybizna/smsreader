<?php

namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;

class Account extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['partner_id', 'txn', 'account'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_account";

}
