<?php

namespace Modules\Smsreader\Filament\Resources\AccountResource\Pages;

use Modules\Smsreader\Filament\Resources\AccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccounts extends ListRecords
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
