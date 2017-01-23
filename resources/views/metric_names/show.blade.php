@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Metric - {{ $metricName->name }}
@endsection
{!! Charts::assets() !!}
@section('contentheader_title')
    <h1>Metric <small>{{ $metricName->name }}</small></h1>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
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
                        <h3 class="box-title">Value prevalence</h3>
                    </div>
                    <div class="box-body" style="height: 300px;">
                        <div class="chart">
                            {!! $chart3->render() !!}
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

