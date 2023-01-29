<?php

namespace Modules\Smsreader\Entities;

use Modules\Base\Entities\BaseModel;
use Illuminate\Database\Schema\Blueprint;

class Sms extends BaseModel
{

    protected $fillable = ['name'];
    public $migrationDependancy = [];
    protected $table = "smsreader_sms";

    /**
     * List of fields for managing postings.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table)
    {
        $table->increments('id');
        $table->string('name');
    }
}