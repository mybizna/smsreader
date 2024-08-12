<?php

namespace Modules\Smsreader\Filament\Resources\RequestsResource\Pages;

use Modules\Smsreader\Filament\Resources\RequestsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRequests extends ListRecords
{
    protected static string $resource = RequestsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
