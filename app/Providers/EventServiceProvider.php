<?php

namespace Modules\Smsreader\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Base\Events\ModelCreated;
use Modules\Smsreader\Listeners\SmsreaderSmsCreated;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ModelCreated::class => [
            SmsreaderSmsCreated::class,
        ],
    ];

}
