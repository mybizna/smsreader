<?php

namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;
use Modules\Smsreader\Models\Format;
use Modules\Smsreader\Models\Incoming;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Confirming extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['phone', 'code', 'name', 'format_id', 'incoming_id',
        'amount', 'account', 'date_sent', 'completed', 'successful'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_confirming";

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
    public function format(): BelongsTo
    {
        return $this->belongsTo(Format::class);
    }

    /**
     * Add relationship to Incoming
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function incoming(): BelongsTo
    {
        return $this->belongsTo(Incoming::class);
    }


    public function migration(Blueprint $table): void
    {
        $table->id();

        $table->char('phone', 255);
        $table->char('code', 255);
        $table->char('name', 255);
        $table->datetime('date_sent');
        $table->foreignId('format_id')->nullable()->constrained(table: 'smsreader_format')->onDelete('set null');
        $table->foreignId('incoming_id')->nullable()->constrained(table: 'smsreader_incoming')->onDelete('set null');
        $table->decimal('amount', 20, 2)->nullable();
        $table->char('account', 255)->nullable();
        $table->tinyInteger('completed')->nullable()->default(0);
        $table->tinyInteger('successful')->nullable()->default(0);

    }
}
