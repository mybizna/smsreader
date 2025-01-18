<?php

namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;
use Modules\Smsreader\Models\Payment;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }


    public function migration(Blueprint $table): void
    {
        $table->id();

        $table->foreignId('payment_id')->nullable()->constrained(table: 'account_payment')->onDelete('set null');
        $table->char('phone', 255);
        $table->char('slug_str', 255);
        $table->string('message');
        $table->datetime('date_sent');

    }
}
