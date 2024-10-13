<?php

namespace Modules\Smsreader\Filament\Resources\IncomingResource\Pages;

use Modules\Base\Filament\Resources\Pages\ListingBase;
use Modules\Smsreader\Filament\Resources\IncomingResource;

// Class List that extends ListBase
class Listing extends ListingBase
{
    protected static string $resource = IncomingResource::class;
}
