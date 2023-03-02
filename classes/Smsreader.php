<?php

namespace Modules\Isp\Classes;

use Modules\Smsreader\Entities\Format;
use Modules\Smsreader\Entities\Sms;

class Freeradius
{

    public function processSms($sms)
    {

        $smses = Sms::where(['successful' => false])->first();
        $formats = Format::where(['published' => true])->first();

        foreach ($smses as $key => $sms) {

        }

    }

}
