@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Home
@endsection

@section('contentheader_title')
    Database
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Metrics</h3>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered dataTable" id="metrics-table">
                        <thead>
                        <tr>
                            <th>Session Id</th>
                            <th>Metric</th>
                            <th>Value</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('view_scripts')
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#metrics-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! action('MetricController@getData') !!}',
                columns: [
                    {data: 'session_id', name: 'session_id'},
                    {data: 'name', name: 'name'},
                    {data: 'value', name: 'value'},
                    {data: 'updated_at', name: 'updated_at'}
                ]
            });
        });
    </script>
@endsection

<!-- Bootstrap JavaScript -->

