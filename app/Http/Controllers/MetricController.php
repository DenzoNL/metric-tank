<?php

namespace App\Http\Controllers;

use App\Metric;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class MetricController extends Controller
{
    public function getData()
    {
        return Datatables::of(Metric::query())->make(true);
    }

}
