@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Sessions
@endsection

@section('contentheader_title')
    Sessions
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sessions</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered dataTable" id="sessions-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Device UID</th>
                                <th>Platform</th>
                                <th>Game</th>
                                <th>Build</th>
                                <th>IP Address</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
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
            $('#sessions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! action('SessionController@getData') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'uid', name: 'devices.uid'},
                    {data: 'platform_name', name: 'platforms.name'},
                    {data: 'game_name', name: 'games.name'},
                    {data: 'game_build_name', name: 'game_builds.name'},
                    {data: 'ip_address', name: 'ip_address'}
                ]
            });
        });
    </script>
@endsection

<!-- Bootstrap JavaScript -->

