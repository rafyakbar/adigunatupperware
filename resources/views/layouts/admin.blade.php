<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Adiguna Tupperware</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .hiddenRow {
            padding: 0 4px !important;
        }
    </style>
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
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/material-dashboard.js?v=1.2.0') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.js') }}"></script>
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.js') }}"></script>
<script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript">
    $('#date-end').bootstrapMaterialDatePicker({
        weekStart: 0, time: false
    });
    $('#date-end').bootstrapMaterialDatePicker('setMinDate', $('#date-start').val());
    $('#date-start').bootstrapMaterialDatePicker({
        weekStart: 0, time: false
    }).on('change', function (e, date) {
        $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
    });
</script>
<script>
    $().ready(function () {
        tinymce.init({
            selector: '.use-tinymce',
            entity_encoding: "raw",
            height: 300,
            theme: 'modern',
            toolbar1: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable-barang').DataTable({
            responsive: true,
            "paging": false,
            "info": false,
            "columnDefs": [
                {"orderable": false, "targets": 5}
            ]
        });
    });
    $(document).ready(function () {
        $('.datatable-monitoring').DataTable({
            responsive: true,
            "paging": false,
            "info": false,
            "columnDefs": [
                {"orderable": false, "targets": 4}
            ]
        });
    });
    $(document).ready(function () {
        $('.datatable-daftarpesanan').DataTable({
            responsive: true,
            "paging": false,
            "info": false,
            "columnDefs": [
                {"orderable": false, "targets": 2},
                {"orderable": false, "targets": 5}
            ]
        });
    });
    $(document).ready(function () {
        $('.datatable-keuangan').DataTable({
            responsive: true,
            "lengthMenu": [[5, 10, 20, 40, 80, 100, -1], [5, 10, 20, 40, 80, 100, "Semua pesanan"]],
            "columnDefs": [
                {"orderable": false, "targets": 2},
                {"orderable": false, "targets": 5}
            ]
        });
    });
    $(document).ready(function () {
        $('.datatable-detailpesanan').DataTable({
            responsive: true,
            "info": false,
            "lengthMenu": [[5, 10, 20, 40, 80, 100, -1], [5, 10, 20, 40, 80, 100, "Semua barang"]],
            "columnDefs": [
                {"orderable": false, "targets": 3},
                {"orderable": false, "targets": 4},
                {"orderable": false, "targets": 5}
            ]
        });
    });
    $(document).ready(function () {
        $('.datatable-general').DataTable({
            responsive: true,
            "info": false,
            "lengthMenu": [[5, 10, 20, 40, 80, 100, -1], [5, 10, 20, 40, 80, 100, "Semua data"]],
        });
    });
    $(document).ready(function () {
        $('.datatable-kategori').DataTable({
            responsive: true,
            "info": false,
            "sort": false,
            "searching": false,
            "lengthMenu": [[5, 10, 20, 40, 80, 100, -1], [5, 10, 20, 40, 80, 100, "Semua data"]],
        });
    });
    $(document).ready(function () {
        $('.datatable-pengumuman').DataTable({
            responsive: true,
            "paging": false,
            "info": false,
            "columnDefs": [
                {"orderable": false, "targets": 4}
            ]
        });
    });
</script>
<script type="text/javascript">
    function autoComplete() {
        $('.kode').select2({
            placeholder: 'Cari berdasarkan kode/nama barang...',
            ajax: {
                url: '{{ route('acbarang') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.kode + ' (stok : ' + item.stok + ', ' + item.nama + ')',
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    }

    autoComplete();
</script>
<script type="text/javascript">
    function tambah() {
        $('#list-barang tr:last').after('<tr><td><select class="kode form-control" name="kode[]" required></select></td><td><input class="form-control" type="number" name="jumlah[]" min="1" required></td><td><button type="button" class="btn btn-danger btn-sm" onclick="$(this).parent().parent().remove()">Hapus</button></td></tr>');
        autoComplete();
    }
</script>
</html>
