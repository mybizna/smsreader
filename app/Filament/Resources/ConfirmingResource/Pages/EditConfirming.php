<?php

namespace Modules\Smsreader\Filament\Resources\ConfirmingResource\Pages;

use Modules\Smsreader\Filament\Resources\ConfirmingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConfirming extends EditRecord
{
    protected static string $resource = ConfirmingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
