<?php


use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Blacklist extends BaseModel
{

    protected $fillable = ['sender'];
    public $migrationDependancy = [];
    protected $table = "smsreader_blacklist";

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
