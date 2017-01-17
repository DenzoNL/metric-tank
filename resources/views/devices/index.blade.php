@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Devices
@endsection

@section('contentheader_title')
    Devices
@endsection

@section('main-content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Devices</h3>
                </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered dataTable" id="devices-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Uid</th>
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
            $('#devices-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! action('DeviceController@getData') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'uid', name: 'uid'}
                ]
            });
        });
    </script>
@endsection

<!-- Bootstrap JavaScript -->

