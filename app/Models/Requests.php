<?php

namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;
use Modules\Smsreader\Models\Payment;

class Requests extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['payment_id', 'phone', 'message', 'date_sent'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_requests";

    /**
     * Adding relationship to Payment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

}
