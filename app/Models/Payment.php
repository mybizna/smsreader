<?php

namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;
use Modules\Smsreader\Models\Format;
use Modules\Smsreader\Models\Incoming;

class Payment extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['phone', 'code', 'name', 'format_id', 'incoming_id', 'partner_id',
        'amount', 'account', 'date_sent', 'completed', 'successful'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_payment";

    /**
     * Determine if the model should be deleted.
     *
     * @var bool
     */
    protected bool $can_delete = false;

    /**
     * Add relationship to Format
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function format()
    {
        return $this->belongsTo(Format::class);
    }

    /**
     * Add relationship to Incoming
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function incoming()
    {
        return $this->belongsTo(Incoming::class);
    }

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

}
