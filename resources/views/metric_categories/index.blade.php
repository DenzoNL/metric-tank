@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Metric Categories
@endsection

@section('contentheader_title')
    Categories
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categories</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered dataTable" id="categories-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
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
                        <h3 class="box-title">Add new category</h3>
                    </div>
                    <?= Former::open()
                        ->id('storeMetricCategory')
                        ->class('form-horizontal')
                        ->action(action('MetricCategoryController@store'))
                        ->method('POST'); ?>
                    <div class="box-body">


                        <?= Former::text('name')
                            ->placeholder('The name of your category')
                            ->required(); ?>

                        <?= Former::textarea('description')
                            ->placeholder('A short description of the category')
                            ->rows(5)
                            ->required(); ?>
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
            $('#categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! action('MetricCategoryController@getData') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'metric_categories.name'},
                    {data: 'description', name: 'metric_categories.description'}
                ]
            });
        });
    </script>
@endsection

<!-- Bootstrap JavaScript -->

