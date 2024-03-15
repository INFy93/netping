<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Illuminate\Http\Request;

class BdcomController extends Controller
{
    public function getTemperature($id)
    {
        $temperature = Temperature::where('bdcom_id', $id)
            ->select('temperature')
            ->first();

        return response()->json($temperature);
    }
}
