<?php

namespace Modules\Smsreader\Filament\Resources\IncomingResource\Pages;

use Modules\Smsreader\Filament\Resources\IncomingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncoming extends EditRecord
{
    protected static string $resource = IncomingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
