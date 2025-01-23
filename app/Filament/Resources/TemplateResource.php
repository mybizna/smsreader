<?php

namespace Modules\Smsreader\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Smsreader\Models\Template;

class TemplateResource extends BaseResource
{
    protected static ?string $model = Template::class;

    protected static ?string $slug = 'smsreader/template';

    protected static ?string $navigationGroup = 'SMS';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


}
