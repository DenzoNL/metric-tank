@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Platforms
@endsection

@section('contentheader_title')
    Platforms
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Platforms</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered dataTable" id="platforms-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
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
                        <h3 class="box-title">Add new platform</h3>
                    </div>
                    <?= Former::open()
                        ->id('storePlatform')
                        ->class('form-horizontal')
                        ->action(action('PlatformController@store'))
                        ->method('POST'); ?>
                    <div class="box-body">


                        <?= Former::text('name')
                            ->placeholder('The name of your platform')
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
            $('#platforms-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! action('PlatformController@getData') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'platforms.name'},
                ]
            });
        });
    </script>
@endsection

<!-- Bootstrap JavaScript -->

