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
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"/>
</head>
<body>

<div class="container">
    <h2>Pencarian Autocomplete di Laravel Menggunakan Ajax</h2>
    <br/>
    <select class="kode form-control" style="width:500px;" name="kode[]"></select>
</div>

{{--<script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('js/arrive.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/bootstrap-notify.js') }}"></script>--}}
{{--<script src="{{ asset('js/material-dashboard.js?v=1.2.0') }}"></script>--}}
{{--<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/dataTables.responsive.js') }}"></script>--}}
{{--<script type="text/javascript">--}}
    {{--$('.kode').select2({--}}
        {{--placeholder: 'Cari...',--}}
        {{--ajax: {--}}
            {{--url: '{{ route('acbarang') }}',--}}
            {{--dataType: 'json',--}}
            {{--delay: 250,--}}
            {{--processResults: function (data) {--}}
                {{--return {--}}
                    {{--results:  $.map(data, function (item) {--}}
                        {{--return {--}}
                            {{--text: item.kode + '|' + item.nama,--}}
                            {{--id: item.id--}}
                        {{--}--}}
                    {{--})--}}
                {{--};--}}
            {{--},--}}
            {{--cache: true--}}
        {{--}--}}
    {{--});--}}

{{--</script>--}}
</body>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/arrive.min.js') }}"></script>
<script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/material-dashboard.js?v=1.2.0') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.use-datatable').DataTable({
            responsive: true,
            "paging":   false,
            "info":     false
        });
    });
</script>
<script type="text/javascript">
    $('.kode').select2({
        placeholder: 'Cari...',
        ajax: {
            url: '{{ route('acbarang') }}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.kode + '|' + item.nama,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

</script>
<script type="text/javascript">
    function tambah() {
        $('#list-barang tr:last').after('<tr><td><input class="form-control" type="text" name="barang[]" required></td><td><input class="form-control" type="number" name="jumlah[]" min="1" required></td><td><button type="button" class="btn btn-danger btn-sm" onclick="$(this).parent().parent().remove()">Hapus</button></td></tr>');
    }
</script>
</html>