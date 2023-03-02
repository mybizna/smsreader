<?php

namespace Modules\Smsreader\Entities;

use Modules\Base\Entities\BaseModel;
use Illuminate\Database\Schema\Blueprint;

class Whitelist extends BaseModel
{

    protected $fillable = ['sender'];
    public $migrationDependancy = [];
    protected $table = "smsreader_whitelist";

    /**
     * List of fields for managing postings.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table)
    {
        $table->increments('id');
        $table->string('sender');
    }
}
