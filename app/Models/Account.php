<?php
namespace Modules\Smsreader\Models;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Models\BaseModel;
use Modules\Partner\Models\Partner;

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

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->unsignedBigInteger('partner_id')->nullable();
        $table->string('account', 255);
        $table->string('txn', 255);

    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('partner_id')->references('id')->on('partner_partner')->onDelete('set null');
    }
}
