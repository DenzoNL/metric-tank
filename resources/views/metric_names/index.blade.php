@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Metric Names
@endsection

@section('contentheader_title')
    Metric Names
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Metric Names</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover dataTable" id="names-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Category</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add new metric name</h3>
                    </div>
                    <?= Former::open()
                        ->id('storeMetricName')
                        ->class('form-horizontal')
                        ->action(action('MetricNameController@store'))
                        ->method('POST'); ?>
                    <div class="box-body">


                        <?= Former::text('name')
                            ->placeholder('The name of the metric')
                            ->required(); ?>

                        <?= Former::select('metric_category_id')->fromQuery(App\MetricCategory::all())
                            ->label('Category')
                            ->required() ?>

                    </div>
                    <div class="box-footer">
                        <?= Former::primary_submit('Submit')->addClass('pull-right') ?>
                    </div>
                    <?= Former::close(); ?>
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
            $('#names-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! action('MetricNameController@getData') !!}',
                columns: [
                    {data: 'id', name: 'metric_names.id'},
                    {data: 'name', name: 'metric_names.name'},
                    {data: 'category_name', name: 'metric_categories.name'}
                ]
            });

            var table = $('#names-table').DataTable();

            $('#names-table tbody').on('click', 'tr', function () {
                var sel = getSelection().toString();
                if (!sel) {
                    var data = table.row(this).data();
                    window.open(window.location.href + '/' + data['id'], "_self");
                }
            });
        });
    </script>
@endsection

<!-- Bootstrap JavaScript -->

