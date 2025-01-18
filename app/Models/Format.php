<?php

namespace Modules\Smsreader\Models;

use Modules\Base\Models\BaseModel;
use Illuminate\Database\Schema\Blueprint;

class Format extends BaseModel
{
    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['title', 'slug', 'format', 'fields_str', 'published'];

    /**
     * The table associated with the modelc string
     */
    protected $table = "smsreader_format";


    public function migration(Blueprint $table): void
    {
        $table->id();

        $table->char('title', 255);
        $table->char('slug', 255);
        $table->string('format');
        $table->string('fields_str');
        $table->enum('action', ['payment', 'confirming', 'account', 'withdraw', 'others'])->nullable();
        $table->integer('ordering')->default(5);
        $table->tinyInteger('published')->default(true);

    }
}
