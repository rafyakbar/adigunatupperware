@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Cek keuangan</h4>
            <p class="category">
                <b>{{ \Illuminate\Support\Carbon::parse($awal)->toFormattedDateString() }}</b>
                sampai dengan
                <b>{{ \Illuminate\Support\Carbon::parse($akhir)->toFormattedDateString() }}</b>
            </p>
        </div>
        <div class="card-content table-responsive">
            <div class="row">
                <div class="col-md-11" style="margin: 0 auto;float: none">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Tanggal mulai</label>
                                <input type="text" class="form-control" id="date-start"
                                       value="{{ \Illuminate\Support\Carbon::parse($awal)->toDateString() }}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Tanggal terakhir</label>
                                <input type="text" class="form-control" id="date-end"
                                       value="{{ \Illuminate\Support\Carbon::parse($akhir)->toDateString() }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" onclick="getLink()" class="btn btn-success pull-left"
                                    style="margin-top: 30px">Cek keuangan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <table class="table datatable-keuangan">
                <thead>
                <tr>
                    <th class="text-center"><i class="fa fa-arrows-v fa-fw"></i>No</th>
                    <th><i class="fa fa-arrows-v fa-fw"></i>Nama Pembeli</th>
                    <th>Total</th>
                    <th><i class="fa fa-arrows-v fa-fw"></i>Status</th>
                    <th><i class="fa fa-arrows-v fa-fw"></i>Waktu</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pesanan as $item)
                    <tr @if($item->status == \App\Pesanan::STATUS[0]) class="success" @else class="warning" @endif>
                        <td class="text-center">{{ ++$no }}</td>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td>Rp {{ number_format(\App\Pesanan::totalPembayaran($item), 0, ',', '.') }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <form id="hapus-{{ $item->id }}" action="{{ route('hapus.pesanan') }}" method="post"
                                  style="display: none">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                            </form>
                            <div class="btn-group">
                                <a href="{{ route('detailpesanan', ['id' => $item->id]) }}" class="btn btn-info btn-sm">Detail</a>
                                <button class="btn btn-danger btn-sm"
                                        onclick="if (confirm('Apakah anda yakin ingin menghapus pesanan ini?')){ event.preventDefault();document.getElementById('hapus-{{ $item->id }}').submit();}">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr>
            <p>Total pembayaran yang <b>lunas</b> : <b>Rp {{ number_format($lunas, 0, ',', '.') }}</b></p>
            <p>Total pembayaran yang <b>belum lunas</b> : <b>Rp {{ number_format($belumlunas, 0, ',', '.') }}</b></p>
            <p>Total <b>semua</b> pembayaran : <b>Rp {{ number_format($lunas + $belumlunas, 0, ',', '.') }}</b></p>
        </div>
    </div>

    <script type="text/javascript">
        function getLink() {
            var start = $('#date-start').val();
            var end = $('#date-end').val();
            if (start != '' && end != '') {
                var link = "{{ url('') }}/keuangan/" + start + "/" + end;
                window.location.href = link;
            }
            else {
                alert('Isi semua field!');
            }
        }
    </script>
@endsection