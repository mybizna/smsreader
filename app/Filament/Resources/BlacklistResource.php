<?php

namespace Modules\Smsreader\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Smsreader\Models\Blacklist;

class BlacklistResource extends BaseResource
{
    protected static ?string $model = Blacklist::class;

    protected static ?string $slug = 'smsreader/blacklist';

    protected static ?string $navigationGroup = 'SMS';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


}
