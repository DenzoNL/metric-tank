<?php

namespace App\Http\Controllers;

use App\Device;
use App\Metric;
use App\MetricName;
use App\Platform;
use App\Session;
use App\GameBuild;
use Illuminate\Http\Request;

class MetricAPIController extends Controller
{
    /**
     * Return the metric for a given id
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $metric = Metric::find($id);

        /* If the metric was not found, return a 404 */
        if (!$metric) {
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
        /* Check whether API key is valid */
        $build = GameBuild::findOrFail($request->game_build_id);

        if($build->game->api_key != $request->api_key)
        {
            return response()->json(['authentication_error' => 'Invalid API key']);
        }

        // Find all necessary id's in the database, or create them if necessary
        $device = Device::firstOrCreate(['uid' => $request->device_uid]);
        $platform = Platform::firstOrCreate(['name' => $request->platform_name]);
        $metric_name = MetricName::firstOrCreate(['name' => $request->metric_name]);
        $session = Session::firstOrCreate([
            'device_id' => $device->id,
            'platform_id' => $platform->id,
            'game_build_id' => $build->id,
        ]);

        /* Check whether API key is valid */
        if(!$session->game_build->game->api_key == $request->api_key)
        {
            return response()->json(['authentication_error' => 'Invalid API key']);
        }

        /* If metric exists*/
        $metric = Metric::where(['session_id' => $session->id, 'metric_name_id' => $metric_name->id, 'value' => $request->value])->first();

        if ($metric) {
            $metric->increment('entries');
            return response()->json(['created' => true, 'new' => false]);
        } else if(!$metric) {
            /* If metric doesn't exist, create it*/
            $metric = Metric::create(['session_id' => $session->id, 'metric_name_id' => $metric_name->id, 'value' => $request->value]);
            return response()->json(['created' => true, 'new' => true]);
        }
        else {
            return response()->json(['created' => false]);
        }
    }
}
