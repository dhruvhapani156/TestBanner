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
                            <h3 class="card-title">Form Field</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        @if(!empty($record))
                            {!! Form::model($record, ['route' => [$route.'update',$record->id],'files' =>true , 'id'=>'myform', 'method' => 'patch', 'class' => 'ajax_submit']) !!}
                        @else
                            {!! Form::open(['url' => route($route.'store'), 'files' =>true, 'method' => 'post','id'=>'myform' ,'class' => 'ajax_submit']) !!}
                        @endif
                        <div class="card-body">
                            <div class="message-section">
                                @include('admin.message_section')
                            </div>
                            @include('admin.video_upload.form')
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ route($route.'index') }}" type="submit" class="btn btn-default">Back</a>
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

