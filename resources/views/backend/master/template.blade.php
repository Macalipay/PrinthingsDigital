<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PrinThings Digital Services</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href={{asset('plugins/fontawesome-free/css/all.min.css')}}>
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href={{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}>
  <link rel="stylesheet" href={{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}>
  <link rel="stylesheet" href={{asset('plugins/jqvmap/jqvmap.min.css')}}>
  <link rel="stylesheet" href={{asset('dist/css/adminlte.min.css')}}>
  <link rel="stylesheet" href={{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}>
  <link rel="stylesheet" href={{asset('plugins/daterangepicker/daterangepicker.css')}}>
  <link rel="stylesheet" href={{asset('plugins/summernote/summernote-bs4.css')}}>
  <link rel="stylesheet" href={{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}>
  <link rel="stylesheet" href={{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}>
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700' rel="stylesheet">
  <style>
    .badge {
        font-size: 100% !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('backend.partials.topnav')
    @include('backend.partials.sidebar')
    @yield('content')
@include('backend.partials.footer')

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <!-- /.control-sidebar -->
</div>
<script src={{asset('plugins/jquery/jquery.min.js')}}></script>
<script src={{asset('plugins/jquery-ui/jquery-ui.min.js')}}></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
<script src={{asset('plugins/chart.js/Chart.min.js')}}></script>
<script src={{asset('plugins/sparklines/sparkline.js')}}></script>
{{-- <script src="plugins/jqvmap/jquery.vmap.min.js"></script> --}}
{{-- <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script> --}}
<script src={{asset('plugins/jquery-knob/jquery.knob.min.js')}}></script>
<script src={{asset('plugins/moment/moment.min.js')}}></script>
<script src={{asset('plugins/daterangepicker/daterangepicker.js')}}></script>
<script src={{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}></script>
<script src={{asset('plugins/summernote/summernote-bs4.min.js')}}></script>
<script src={{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}></script>
<script src={{asset('dist/js/adminlte.js')}}></script>
<script src={{asset('dist/js/pages/dashboard.js')}}></script>
<script src={{asset('dist/js/demo.js')}}></script>
<script src={{asset('plugins/datatables/jquery.dataTables.min.js')}}></script>
<script src={{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}></script>
<script src={{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}></script>
<script>
  $.ajaxSetup({
    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
  });
</script>
@yield('scripts')
</body>
</html>
