@extends('layouts.admin')

@section('konten')
    <div class="alert alert-warning">
        Isi semua data dengan benar dan pastikan stok mencukupi!<br>
        Karena pesanan yang telah disimpan tidak akan bisa diedit namun dapat dibatalkan.
    </div>
    <div class="card">
        <form action="{{ route('tambah.pesanan') }}" method="post">
            {{ csrf_field() }}
            <div class="card-content">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header" data-background-color="blue">
                                <h4 class="title">Data pembeli</h4>
                                <p class="category">Isi data pembeli di bawah ini dengan benar!</p>
                            </div>
                            <div class="card-content">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="form-control" name="nama_pelanggan" type="text" minlength="1"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input class="form-control" name="nohp_pelanggan" type="number" minlength="10"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="email_pelanggan" type="email" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat_pelanggan" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header" data-background-color="green">
                                <h4 class="title">Barang</h4>
                                <p class="category">Tambahkan barang yang akan dibeli!</p>
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <button type="button" onclick="tambah()" class="btn btn-primary">Tambah barang
                                        </button>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="status" class="form-control" style="margin-top: -3%">
                                            <option value="Lunas">Pilih status pesanan (default : lunas)</option>
                                            @foreach(\App\Pesanan::STATUS as $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table class="table" id="list-barang">
                                    <thead>
                                    <tr>
                                        <th width="65%">Kode barang</th>
                                        <th width="15%">Jumlah</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <select class="kode form-control" name="kode[]" required></select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" name="jumlah[]" min="1" value="">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" disabled>Hapus</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" value="Simpan" class="btn btn-success pull-right">
            </div>
        </form>
    </div>
@endsection