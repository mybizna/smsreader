<?php
namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;
use Illuminate\Database\Schema\Blueprint;

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


    public function migration(Blueprint $table): void
    {
        $table->id();

        $table->string('sender', 255);


    }
}
