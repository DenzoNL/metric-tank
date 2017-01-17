<?php

namespace App\Http\Controllers;

use App\Metric;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class MetricController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getData()
    {
        $metrics = DB::table('metrics')
            ->join('metric_names', 'metric_name_id', '=', 'metric_names.id')
            ->select('metric_names.name', 'metrics.session_id', 'metrics.value', 'metrics.entries', 'metrics.updated_at');
        return Datatables::of($metrics)->make(true);
    }

}
