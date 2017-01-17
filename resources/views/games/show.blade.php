@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Games
@endsection

@section('contentheader_title')
    <h1>Games<small>{{ $game->name }}</small></h1>
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Builds</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered dataTable" id="games-table">
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
                        <h3 class="box-title">Add new build</h3>
                    </div>
                    <?= Former::open()
                        ->id('storeBuild')
                        ->class('form-horizontal')
                        ->action(action('GameBuildController@store', ['game_id' => $game->id]))
                        ->method('POST'); ?>
                    <div class="box-body">


                        <?= Former::text('name')
                            ->placeholder('The name or version of the game build')
                            ->required(); ?>

                        <?= Former::textarea('description')
                            ->placeholder('A short description of the game build')
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
                ajax: '{!! action('GameController@getBuilds', ['id' => $game->id]) !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'game_builds.name'},
                    {data: 'description', name: 'game_builds.description'}
                ]
            });
        });
    </script>
@endsection

<!-- Bootstrap JavaScript -->

