<?php

namespace Modules\Smsreader\Filament\Resources\WhitelistResource\Pages;

use Modules\Smsreader\Filament\Resources\WhitelistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWhitelist extends EditRecord
{
    protected static string $resource = WhitelistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}