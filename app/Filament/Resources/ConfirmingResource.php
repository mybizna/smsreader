<?php

namespace Modules\Smsreader\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Smsreader\Models\Confirming;

class ConfirmingResource extends BaseResource
{
    protected static ?string $model = Confirming::class;

    protected static ?string $slug = 'smsreader/confirming';

    protected static ?string $navigationGroup = 'SMS';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
}
