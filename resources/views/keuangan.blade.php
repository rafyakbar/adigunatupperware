@extends('layouts.admin')

@section('konten')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Filter</h4>
                </div>
                <div class="card-content">
                    <div class="form-group">
                        <label>Tanggal mulai</label>
                        <input type="text" class="form-control" id="date-start" value="{{ \Illuminate\Support\Carbon::parse($awal)->toDateString() }}">
                    </div>
                    <div class="form-group">
                        <label>Tanggal terakhir</label>
                        <input type="text" class="form-control" id="date-end" value="{{ \Illuminate\Support\Carbon::parse($akhir)->toDateString() }}">
                    </div>
                    <button type="submit" onclick="getLink()" class="btn btn-success pull-right">Lihat keuangan</button>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="title">
                        {{ \Illuminate\Support\Carbon::parse($awal)->toFormattedDateString() }}
                        -
                        {{ \Illuminate\Support\Carbon::parse($akhir)->toFormattedDateString() }}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function getLink() {
            var start = $('#date-start').val();
            var end = $('#date-end').val();
            if (start != '' && end != ''){
                var link = "{{ url('') }}/keuangan/" + start + "/" + end;
                window.location.href = link;
            }
            else {
                alert('Isi semua field!');
            }
        }
    </script>
@endsection