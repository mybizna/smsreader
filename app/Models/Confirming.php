<?php
namespace Modules\Smsreader\Models;

use Base\Casts\Money;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Models\BaseModel;
use Modules\Smsreader\Models\Format;
use Modules\Smsreader\Models\Incoming;

class Confirming extends BaseModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' => Money::class, // Use the custom MoneyCast
    ];
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

        $table->char('phone', 255);
        $table->char('code', 255);
        $table->char('name', 255);
        $table->datetime('date_sent');
        $table->unsignedBigInteger('format_id')->nullable();
        $table->unsignedBigInteger('incoming_id')->nullable();
        $table->integer('amount')->nullable();
        $table->string('currency')->default('USD');
        $table->char('account', 255)->nullable();
        $table->tinyInteger('completed')->nullable()->default(0);
        $table->tinyInteger('successful')->nullable()->default(0);

    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('format_id')->references('id')->on(table: 'smsreader_format')->onDelete('set null');
        $table->foreign('incoming_id')->references('id')->on(table: 'smsreader_incoming')->onDelete('set null');
    }
}
