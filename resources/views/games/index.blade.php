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
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Games</h3>
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
                    {data: 'name', name: 'games.name'},
                    {data: 'description', name: 'games.description'}
                ]
            });
        });
    </script>
@endsection

<!-- Bootstrap JavaScript -->

