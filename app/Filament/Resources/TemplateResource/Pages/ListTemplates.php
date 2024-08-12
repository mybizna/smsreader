<?php

namespace Modules\Smsreader\Filament\Resources\TemplateResource\Pages;

use Modules\Smsreader\Filament\Resources\TemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTemplates extends ListRecords
{
    protected static string $resource = TemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
