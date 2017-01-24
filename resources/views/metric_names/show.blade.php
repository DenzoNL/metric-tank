@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Metric - {{ $metricName->name }}
@endsection
{!! Charts::assets() !!}
@section('contentheader_title')
    <h1>Metric
        <small>{{ $metricName->name }}</small>
    </h1>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $metricName->metrics->sum('entries') }}</h3>
                        <p>Total entries</p>
                    </div>
                    <div class="icon" style="top: 5px;">
                        <i class="ion ion-information"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ count($metricName->metrics) }}</h3>

                        <p>Unique Submissions</p>
                    </div>
                    <div class="icon" style="top: 5px;">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <?php
                        $avg = collect();
                        foreach ($metricName->metrics as $metric) {
                            for ($i = 0; $i < $metric->entries; $i++) {
                                $avg->push(['value' => $metric->value]);
                            }
                        }
                        ?>
                        <h3>{{ number_format($avg->avg('value'), 2) }}</h3>

                        <p>Average Value</p>
                    </div>
                    <div class="icon" style="top: 5px;">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ count($metricName->metrics) / count(App\Metric::all()) * 100}}<sup
                                    style="font-size: 20px">%</sup></h3>

                        <p>Percentage of all metrics</p>
                    </div>
                    <div class="icon" style="top: 5px;">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Number of entries by Month</h3>
                    </div>
                    <div class="box-body" style="height: 300px;">
                        <div class="chart">
                            {!! $chart1->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Average number of entries by Month</h3>
                    </div>
                    <div class="box-body" style="height: 300px;">
                        <div class="chart">
                            {!! $chart2->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Number of entries per value</h3>
                    </div>
                    <div class="box-body" style="height: 300px;">
                        <div class="chart">
                            {!! $chart3->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Average value per entry</h3>
                    </div>
                    <div class="box-body" style="height: 300px;">
                        <div class="chart">
                            {!! $chart4->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('view_scripts')

@endsection

<!-- Bootstrap JavaScript -->

