@extends('layouts.admin')

@section('konten')
    <div class="alert alert-info">
        Pada saat membatalkan salah satu barang, maka stok barang yang dibatalkan akan bertambah sesuai dengan jumlah yang dibeli.
        @if(session()->has('message'))
            <br>
            {!! session()->get('message') !!}
        @endif
    </div>
    <div class="card">
        <div class="card-content">
            <div class="alert alert-warning">
                Pesanan ini dilayani oleh {!! (!is_null($pesanan->user_id)) ? '<b>'.$pesanan->user()->name.'</b>' : '(pegawai yang melayani pesanan ini telah dihapus)' !!}
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header" data-background-color="blue">
                            <h4 class="title">Data pembeli</h4>
                        </div>
                        <div class="card-content">
                            <label>Nama</label><br>
                            <b>{{ $pesanan->nama_pelanggan }}</b><br>
                            <label>Email</label><br>
                            <b>{{ $pesanan->email_pelanggan }}</b><br>
                            <label>No HP</label><br>
                            <b>{{ $pesanan->nohp_pelanggan }}</b><br>
                            <label>Alamat</label><br>
                            <b>{{ $pesanan->alamat_pelanggan }}</b><br>
                            <label>Keterangan</label><br>
                            <b>{{ $pesanan->created_at }}</b><br>
                            <b>({{ $pesanan->created_at->diffForHumans() }})</b>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h4 class="title">Barang-barang yang dibeli</h4>
                        </div>
                        <div class="card-content table-responsive">
                            <table class="table datatable-detailpesanan">
                                <thead>
                                <tr>
                                    <td width="25%">Nama</td>
                                    <td width="20%">Kategori</td>
                                    <td width="5%">Jumlah</td>
                                    <td width="20%">Harga barang pada saat itu</td>
                                    <td width="20%">Total</td>
                                    <td width="10%">Aksi</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pesanan->barang as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ (!is_null($item->kategori_id)) ? $item->kategori()->nama : '-' }}</td>
                                        <td>{{ $item->pivot->jumlah }}</td>
                                        <td>Rp {{ number_format($item->pivot->harga_sekarang, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->pivot->harga_sekarang * $item->pivot->jumlah, 0, ',', '.') }}</td>
                                        <td>
                                            <form action="{{ route('hapus.pesanan.barang') }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="barang_id" value="{{ $item->id }}">
                                                <input type="hidden" name="pesanan_id" value="{{ $pesanan->id }}">
                                                <input type="hidden" name="jumlah" value="{{ $item->pivot->jumlah }}">
                                                <button class="
btn btn-danger btn-sm" type="submit">Batalkan</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <b style="margin-left: 49%">Total pembayaran : Rp {{ number_format(\App\Pesanan::totalPembayaran($pesanan), 0, ',', '.') }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection