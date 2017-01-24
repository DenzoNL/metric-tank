<?php

namespace App\Http\Controllers;

use App\Metric;
use App\MetricCategory;
use App\MetricName;
use Carbon\Carbon;
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
     * @param  \Illuminate\Http\Request $request
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metricName = MetricName::findOrFail($id);

        $thisMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonth(1);
        $lastMonth2 = Carbon::now()->subMonth(2);

        /* Gather metrics by month */
        $thisMonthMetrics = Metric::whereMonth('created_at', $thisMonth->month)->where('metric_name_id', $id)->get();
        $lastMonthMetrics = Metric::whereMonth('created_at', $lastMonth->month)->where('metric_name_id', $id)->get();
        $lastMonth2Metrics = Metric::whereMonth('created_at', $lastMonth2->month)->where('metric_name_id', $id)->get();

        /* Gather number of entries per unique value */
        $metrics = Metric::where('metric_name_id', $id)->get();
        $uniques = $metrics->unique('value')->sortBy('value');
        $result = collect();

        foreach ($uniques as $unique) {
            $result->push(['value' => $unique->value, 'entries' => $metrics->where('value', $unique->value)->sum('entries')]);
        }

        $avg_thisMonth = collect();
        $avg_lastMonth = collect();
        $avg_lastMonth2 = collect();

        foreach ($thisMonthMetrics as $metric) {
            for ($i = 0; $i < $metric->entries; $i++) {
                $avg_thisMonth->push(['value' => $metric->value]);
            }
        }

        foreach ($lastMonthMetrics as $metric) {
            for ($i = 0; $i < $metric->entries; $i++) {
                $avg_lastMonth->push(['value' => $metric->value]);
            }
        }

        foreach ($lastMonth2Metrics as $metric) {
            for ($i = 0; $i < $metric->entries; $i++) {
                $avg_lastMonth2->push(['value' => $metric->value]);
            }
        }

        /* Generate charts */
        $chart1 = Charts::create('line', 'highcharts')
            ->title($metricName->name)
            ->elementLabel('Entries')
            ->labels([$lastMonth2->format('F'), $lastMonth->format('F'), $thisMonth->format('F')])
            ->values([$lastMonth2Metrics->sum('entries'), $lastMonthMetrics->sum('entries'), $thisMonthMetrics->sum('entries')])
            ->responsive(true);

        $chart2 = Charts::create('line', 'highcharts')
            ->title($metricName->name)
            ->elementLabel('Entries')
            ->labels([$lastMonth2->format('F'), $lastMonth->format('F'), $thisMonth->format('F')])
            ->values([$lastMonth2Metrics->avg('entries') ?? 0, $lastMonthMetrics->avg('entries') ?? 0, $thisMonthMetrics->avg('entries') ?? 0])
            ->responsive(true);

        $chart3 = Charts::create('bar', 'highcharts')
            ->title($metricName->name)
            ->elementLabel("Entries")
            ->values($result->pluck('entries'))
            ->labels($result->pluck('value'))
            ->responsive(true);

        $chart4 = Charts::create('line', 'highcharts')
            ->title($metricName->name)
            ->elementLabel('Value')
            ->labels([$lastMonth2->format('F'), $lastMonth->format('F'), $thisMonth->format('F')])
            ->values([$avg_lastMonth2->avg('value') ?? 0, $avg_lastMonth->avg('value') ?? 0, $avg_thisMonth->avg('value') ?? 0])
            ->responsive(true);


        return view('metric_names.show', compact(['metricName', 'chart1', 'chart2', 'chart3', 'chart4']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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
