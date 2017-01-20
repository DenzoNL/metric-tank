<?php

namespace App\Http\Controllers;

use App\MetricCategory;
use App\MetricName;
use Charts;
use DB;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class MetricNameController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('metric_names.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MetricName::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metricName = MetricName::findOrFail($id);

        $chart = Charts::create('line', 'highcharts')
            ->title($metricName->name)
            ->labels(['First', 'Second', 'Third'])
            ->values([5,10,20])
            ->responsive(true);

        return view('metric_names.show', compact(['metricName', 'chart']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MetricName::create($request->all());
        return redirect()->back();
    }

    public function getData()
    {
        $metric_names = DB::table('metric_names')
            ->leftJoin('metric_categories', 'metric_names.metric_category_id', '=', 'metric_categories.id')
            ->select('metric_names.*', 'metric_categories.name AS category_name');
        return Datatables::of($metric_names)->make(true);
    }
}
