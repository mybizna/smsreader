<?php

namespace Modules\Smsreader\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Smsreader\Models\Requests;

class RequestsResource extends BaseResource
{
    protected static ?string $model = Requests::class;

    protected static ?string $slug = 'smsreader/requests';

    protected static ?string $navigationGroup = 'SMS';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
