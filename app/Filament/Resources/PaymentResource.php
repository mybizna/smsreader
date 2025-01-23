<?php

namespace Modules\Smsreader\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Smsreader\Models\Payment;

class PaymentResource extends BaseResource
{
    protected static ?string $model = Payment::class;

    protected static ?string $slug = 'smsreader/payment';

    protected static ?string $navigationGroup = 'SMS';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

}
