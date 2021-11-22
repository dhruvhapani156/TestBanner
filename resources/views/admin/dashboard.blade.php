@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <!-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div> --><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $festival_image }}</h3>

                                <a href="{{ url('admin/image_upload') }}" class="text-white" >
                                    <p>Festival Image</p>
                                </a>
                            </div>
                            <div class="icon">
                                <i class="ion ion-image"></i>
                            </div>
                            <a href="{{ url('admin/image_upload') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $festival_video }}</h3>

                                <p>Festival Video</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-videocam"></i>
                            </div>
                            <a href="{{ url('admin/festival_video_upload') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $business_image }}</h3>

                                <a href="{{ url('admin/business_category_image_upload') }}" class="text-white" >
                                    <p>Business Image </p>
                                </a>
                            </div>
                            <div class="icon">
                                <i class="ion ion-image"></i>
                            </div>
                            <a href="{{ url('admin/business_category_image_upload') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $business_video }}</h3>

                                <a href="{{ url('admin/business_video_upload') }}" class="text-white" >
                                    <p>Business Video</p>
                                </a>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-videocam"></i>
                            </div>
                            <a href="{{ url('admin/business_video_upload') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $greeting_image }}</h3>

                                <a href="{{ url('admin/greeting_image') }}" class="text-white" >
                                    <p>Greeting Image</p>
                                </a>
                            </div>
                            <div class="icon">
                                <i class="ion ion-image"></i>
                            </div>
                            <a href="{{ url('admin/greeting_image') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>


                </div>


                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ url('assets/admin') }}/dist/js/pages/dashboard.js"></script>
@endsection