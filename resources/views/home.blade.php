@extends('layouts.admin')

@section('konten')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="fa fa-download fa-fw"></i>
                </div>
                <div class="card-content">
                    <p class="category">Stok Terbatas</p>
                    <h3 class="title">
                        {{ \App\Barang::where('stok', '<', '10')->where('dihapus', false)->count() }}
                        <small>barang</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-warning fa-fw"></i> Segera isi stok!
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="fa fa-cart-plus fa-fw"></i>
                </div>
                <div class="card-content">
                    <p class="category">Pesanan Hari Ini</p>
                    <h3 class="title">
                        {{ \App\Pesanan::where('created_at', '>=', \Carbon\Carbon::today())->count() }}
                        <small>pesanan</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-calendar fa-fw"></i> {{ \Carbon\Carbon::today()->toDateString() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="red">
                    <i class="fa fa-trash fa-fw"></i>
                </div>
                <div class="card-content">
                    <p class="category">Barang Dihapus</p>
                    <h3 class="title">
                        {{ \App\Barang::where('dihapus', true)->count() }}
                        <small>barang</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-info fa-fw"></i> Dapat direcover oleh pemilik
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="fa fa-bullhorn fa-fw"></i>
                </div>
                <div class="card-content">
                    <p class="category">Pengumuman</p>
                    <h3 class="title">{{ $jum = \App\Pengumuman::where('tampilkan', true)->count() }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="fa fa-volume-up"></i> {{ $jum }} pengumuman oleh pemilik
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-background-color="orange">
            <h4 class="title">Pengumuman!</h4>
        </div>
        <div class="card-content table-responsive">
            <table class="table datatable-general">
                <thead>
                <tr>
                    <td width="8%"><i class="fa fa-arrows-v fa-fw"></i>No</td>
                    <td width="20%"><i class="fa fa-arrows-v fa-fw"></i>Judul</td>
                    <td width="52%"><i class="fa fa-arrows-v fa-fw"></i>Isi</td>
                    <td width="20%"><i class="fa fa-arrows-v fa-fw"></i>Dibuat</td>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Pengumuman::where('tampilkan', true)->orderBy('created_at','desc')->get() as $item)
                    <tr>
                        <td>{{ ++$dump }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{!! $item->keterangan !!}</td>
                        <td>
                            {{ $item->created_at }}<br>
                            ({{ $item->created_at->diffForHumans() }})
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
