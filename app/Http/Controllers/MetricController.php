<?php

namespace App\Http\Controllers;

use App\Device;
use App\GameBuild;
use App\Metric;
use App\MetricName;
use App\Platform;
use App\Session;
use Illuminate\Http\Request;

class MetricController extends Controller
{
    /**
     * Store a new metric
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Find all necessary id's in the database
        $device = Device::firstOrCreate(['uid' => $request->device_uid]);
        $platform = Platform::firstOrCreate(['name' => $request->platform_name]);
        $metric_name = MetricName::firstOrCreate(['name' => $request->metric_name]);
        $session = Session::firstOrCreate([
            'device_id' => $device->id,
            'platform_id' => $platform->id,
            'game_build_id' => $request->game_build_id,
            'ip_address' => $request->ip()
        ]);

        $metric = Metric::create(['session_id' => $session->id, 'metric_name_id' => $metric_name->name]);

        return response()->json(['created' => true]);
    }
}
