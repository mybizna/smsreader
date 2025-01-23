<?php

namespace Modules\Smsreader\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Smsreader\Models\Format;

class FormatResource extends BaseResource
{
    protected static ?string $model = Format::class;

    protected static ?string $slug = 'smsreader/format';

    protected static ?string $navigationGroup = 'SMS';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
