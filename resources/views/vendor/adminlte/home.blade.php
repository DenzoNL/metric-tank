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
                    {{--<table class="table table-striped table-bordered dataTable" id="metrics-table">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>Session Id</th>--}}
                            {{--<th>Metric</th>--}}
                            {{--<th>Value</th>--}}
                            {{--<th>Entries</th>--}}
                            {{--<th>Updated At</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                    {{--</table>--}}
                    {!! $dataTable->table(['class' => 'table table-bordered', true], true) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('view_scripts')
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
            var table = window.LaravelDataTables["dataTableBuilder"];

            setInterval( function () {
                table.ajax.reload(); // user paging is not reset on reload
            }, 10000 );

            $('#dataTableBuilder tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" class="form-control input-sm" placeholder="Search '+title+'" />' );
            } );

            table.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );

            $('#dataTableBuilder tfoot tr').appendTo('#dataTableBuilder thead');

        })


    </script>
    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$('#metrics-table').DataTable({--}}
                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--ajax: '{!! action('MetricController@getData') !!}',--}}
                {{--columns: [--}}
                    {{--{data: 'session_id', name: 'session_id'},--}}
                    {{--{data: 'name', name: 'metric_names.name'},--}}
                    {{--{data: 'value', name: 'value'},--}}
                    {{--{data: 'entries', name: 'entries'},--}}
                    {{--{data: 'updated_at', name: 'updated_at'}--}}
                {{--]--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection

<!-- Bootstrap JavaScript -->

