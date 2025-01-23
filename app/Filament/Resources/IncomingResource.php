<?php

namespace Modules\Smsreader\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Smsreader\Models\Incoming;

class IncomingResource extends BaseResource
{
    protected static ?string $model = Incoming::class;

    protected static ?string $slug = 'smsreader/incoming';

    protected static ?string $navigationGroup = 'SMS';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
