<?php

namespace Modules\Smsreader\Listeners;

use Modules\Smsreader\Classes\Smsreader;

class SmsreaderSmsCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $smsreader = new Smsreader();

        $table_name = $event->table_name;
        
        if ($table_name == 'smsreader_incoming') {
            $model = $event->model;
            $smsreader->processSms($model);
        }

    }
}
