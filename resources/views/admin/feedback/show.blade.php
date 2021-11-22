@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    {{--<div class="col-sm-6 text-right">--}}
                    {{--<ol class="breadcrumb float-sm-right">--}}
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    {{--<li class="breadcrumb-item active">DataTables</li>--}}
                    {{--</ol>--}}
                    {{--</div>--}}
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body  p-0">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="30%">Name</th>
                                    <td width="70%">{{ $record['name'] }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">Description</th>
                                    <td width="70%">{{ $record['description'] }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">Contact </th>
                                    <td width="70%">{{ $record['contact'] }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">Created At</th>
                                    <td width="70%">{{ $record['created_at']->format(config('setting.DATETIME_FORMAT')) }}</td>
                                </tr>
                                <tr>
                                    <th width="30%">Status</th>
                                    <td width="70%">{{ $record['status'] }}</td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ route($route.'index') }}" type="submit" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

