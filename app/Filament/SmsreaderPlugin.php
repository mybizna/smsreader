<?php

namespace Modules\Smsreader\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class SmsreaderPlugin implements Plugin
{
    use ModuleFilamentPlugin;

    public function getModuleName(): string
    {
        return 'Smsreader';
    }

    public function getId(): string
    {
        return 'smsreader';
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
