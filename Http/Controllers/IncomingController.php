<?php

namespace Modules\Smsreader\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Base\Http\Controllers\BaseController;
use Modules\Smsreader\Entities\Incoming;

class IncomingController extends BaseController
{

    public function incoming(Request $request)
    {
        $result = [];

        $data = $request->all();

        try {

            Incoming::create([
                'phone' => (isset($data['from'])) ? $data['from'] : '',
                'message' => (isset($data['text'])) ? $data['text'] : '',
                'date_sent' => (isset($data['sentStamp'])) ? date("Y-m-d H:i:s", $data['sentStamp']) : '',
                'date_received' => (isset($data['receivedStamp'])) ? date("Y-m-d H:i:s", $data['receivedStamp']) : '',
                'sim' => (isset($data['sim'])) ? $data['sim'] : '',
            ]);
        } catch (\Throwable$th) {
            throw $th;
        }

        return response()->json(['status' => true, 'message' => 'SMS added successfully.']);
    }

}
