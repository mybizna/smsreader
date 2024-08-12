<?php

namespace Modules\Smsreader\Filament\Resources\RequestsResource\Pages;

use Modules\Smsreader\Filament\Resources\RequestsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequests extends EditRecord
{
    protected static string $resource = RequestsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
