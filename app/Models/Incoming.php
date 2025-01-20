<?php
namespace Modules\Smsreader\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Models\BaseModel;
use Modules\Sms\Models\Gateway;

class Incoming extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['phone', 'message', 'date_sent', 'params', 'gateway_id', 'is_payment', 'completed', 'successful'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "smsreader_incoming";

    /**
     * Determine if the model should be deleted.
     *
     * @var bool
     */
    protected bool $can_delete = false;

    /**
     * Add relationship to Gateway
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->char('phone', 255);
        $table->string('message');
        $table->datetime('date_sent')->nullable();
        $table->datetime('date_received')->nullable();
        $table->string('sim')->nullable();
        $table->unsignedBigInteger('gateway_id')->nullable();
        $table->string('params')->nullable();
        $table->enum('action', ['payment', 'confirming', 'account', 'withdraw', 'others'])->nullable();
        $table->tinyInteger('is_payment')->nullable()->default(0);
        $table->tinyInteger('completed')->nullable()->default(0);
        $table->tinyInteger('successful')->nullable()->default(0);

    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('gateway_id')->nullable()->constrained(table: 'sms_gateway')->onDelete('set null');
    }
}
