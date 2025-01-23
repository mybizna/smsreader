<?php

namespace Modules\Smsreader\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Smsreader\Models\Account;

class AccountResource extends BaseResource
{
    protected static ?string $model = Account::class;

    protected static ?string $slug = 'smsreader/account';

    protected static ?string $navigationGroup = 'SMS';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
