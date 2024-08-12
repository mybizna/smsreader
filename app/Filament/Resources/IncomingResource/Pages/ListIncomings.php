<?php

namespace Modules\Smsreader\Filament\Resources\IncomingResource\Pages;

use Modules\Smsreader\Filament\Resources\IncomingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIncomings extends ListRecords
{
    protected static string $resource = IncomingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
