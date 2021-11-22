<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Banner maker</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    {{--<link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/daterangepicker/daterangepicker.css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('assets/admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    {{--datepicker--}}


    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admin.layout.header')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')

    @include('admin.layout.footer')

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('assets/admin') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('assets/admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
{{--http://www.bootstraptoggle.com/--}}
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- Bootstrap 4 -->
<script src="{{ url('assets/admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
{{--<!-- ChartJS -->--}}
{{--<script src="{{ url('assets/admin') }}/plugins/chart.js/Chart.min.js"></script>--}}
{{--<!-- Sparkline -->--}}
{{--<script src="{{ url('assets/admin') }}/plugins/sparklines/sparkline.js"></script>--}}
{{--<!-- JQVMap -->--}}
{{--<script src="{{ url('assets/admin') }}/plugins/jqvmap/jquery.vmap.min.js"></script>--}}
{{--<script src="{{ url('assets/admin') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>--}}
{{--<!-- jQuery Knob Chart -->--}}
{{--<script src="{{ url('assets/admin') }}/plugins/jquery-knob/jquery.knob.min.js"></script>--}}

<!-- daterangepicker -->
<script src="{{ url('assets/admin') }}/plugins/moment/moment.min.js"></script>
{{--<script src="{{ url('assets/admin') }}/plugins/daterangepicker/daterangepicker.js"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


<!-- Tempusdominus Bootstrap 4 -->
{{--<script src="{{ url('assets/admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>--}}
{{--<!-- Summernote -->--}}
{{--<script src="{{ url('assets/admin') }}/plugins/summernote/summernote-bs4.min.js"></script>--}}
{{--<!-- overlayScrollbars -->--}}
{{--<script src="{{ url('assets/admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>--}}

<!-- DataTables -->
<script src="{{ url('assets/admin') }}//plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ url('assets/admin') }}//plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- WaitMe -->
<link rel="stylesheet" href="{{ url('assets/admin/') }}/plugins/waitme/waitMe.min.css">
<script src="{{ url('assets/admin/') }}/plugins/waitme/waitMe.min.js"></script>

<!-- bs-custom-file-input -->
<script src="{{ url('assets/admin/') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- AdminLTE App -->
<script src="{{ url('assets/admin') }}/dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ url('assets/admin') }}/dist/js/demo.js"></script>

{{--//datepicker--}}

<script type="text/javascript">
    $(document).ready(function () {
        bsCustomFileInput.init();
        $(".datepicker").attr("autocomplete", "off");
        $( ".datepicker" ).datepicker({
            format: "yyyy-mm-dd",
            startDate: new Date()

        });
    });
</script>

@yield('js')

</body>
</html>
