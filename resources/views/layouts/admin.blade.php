<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Adiguna Tupperware</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"/>
    {{--<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>--}}

</head>

<body>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="{{ asset('img/sidebar-1.jpg') }}">
        <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
    Tip 2: you can also add an image using data-image tag
-->
        @include('layouts.sidemenu')
    </div>
    <div class="main-panel">
        @include('layouts.navbar')
        <div class="content">
            <div class="container-fluid">
                @yield('konten')
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>
</body>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/chartist.min.js') }}"></script>
<script src="{{ asset('js/arrive.min.js') }}"></script>
<script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/material-dashboard.js?v=1.2.0') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.use-datatable').DataTable({
            responsive: true,
            "paging":   false,
            "info":     false
        });
    });
</script>
</html>
