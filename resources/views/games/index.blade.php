@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Games
@endsection

@section('contentheader_title')
    Games
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Games</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-hover table-bordered dataTable" id="games-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>API Key</th>
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
                        <h3 class="box-title">Add new game</h3>
                    </div>
                    <?= Former::open()
                        ->id('storeGame')
                        ->class('form-horizontal')
                        ->action(action('GameController@store'))
                        ->method('POST'); ?>
                    <div class="box-body">


                        <?= Former::text('name')
                            ->placeholder('The name of your game')
                            ->required(); ?>

                        <?= Former::textarea('description')
                            ->placeholder('A short description of your game')
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
            $('#games-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! action('GameController@getData') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'api_key', name: 'api_key'},
                    {data: 'name', name: 'games.name'},
                    {data: 'description', name: 'games.description'}
                ]
            });
            var table = $('#games-table').DataTable();

            $('#games-table tbody').on('click', 'tr', function () {
                var sel = getSelection().toString();
                if (!sel) {
                    var data = table.row(this).data();
                    window.open(window.location.href + '/' + data['id'], "_self");
                }
            });

//            $('#games-table tbody').on('click', 'tr', function () {
//                var data = table.row( this ).data();
//                window.open(window.location.href + '/' + data['id'], "_self");
//            } );
        });
    </script>
@endsection

<!-- Bootstrap JavaScript -->

