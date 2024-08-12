<?php

namespace Modules\Smsreader\Filament\Resources\IncomingResource\Pages;

use Modules\Smsreader\Filament\Resources\IncomingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIncoming extends CreateRecord
{
    protected static string $resource = IncomingResource::class;
}
