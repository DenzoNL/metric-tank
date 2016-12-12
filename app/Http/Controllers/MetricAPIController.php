<?php

namespace App\Http\Controllers;

use App\Device;
use App\Metric;
use App\MetricName;
use App\Platform;
use App\Session;
use Illuminate\Http\Request;

class MetricAPIController extends Controller
{
    /**
     * Return the metric for a given id
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $metric = Metric::find($id);

        /* If the metric was not found, return a 404 */
        if(!$metric) {
            return response()->json(['message', 'Record not found.'], 404);
        }

        /* Return the object */
        return response()->json($metric, 200)->setEncodingOptions(JSON_NUMERIC_CHECK);

    }
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
        ]);

        $metric = Metric::create(['session_id' => $session->id, 'metric_name_id' => $metric_name->id, 'value' => $request->value]);

        if($metric) {
            return response()->json(['created' => true]);
        }
        else {
            return response()->json(['created' => false]);
        }
    }
}
