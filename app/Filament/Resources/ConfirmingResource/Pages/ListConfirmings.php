<?php

namespace Modules\Smsreader\Filament\Resources\ConfirmingResource\Pages;

use Modules\Smsreader\Filament\Resources\ConfirmingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConfirmings extends ListRecords
{
    protected static string $resource = ConfirmingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
