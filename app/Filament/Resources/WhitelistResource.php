<?php

namespace Modules\Smsreader\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Smsreader\Models\Whitelist;

class WhitelistResource extends BaseResource
{
    protected static ?string $model = Whitelist::class;

    protected static ?string $slug = 'smsreader/whitelist';

    protected static ?string $navigationGroup = 'SMS';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
