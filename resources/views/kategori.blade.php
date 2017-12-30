@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="alert alert-warning">
        Saat menghapus kategori, barang yang memiliki kategori tersebut tidak akan memiliki kategori!
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header" data-background-color="red">
                    <h4 class="title">Daftar kategori</h4>
                    <p class="category">Terdapat {{ count($kategori) }} kategori</p>
                </div>
                <div class="card-content table-responsive">
                    <table class="table datatable-kategori">
                        <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Aksi</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($kategori as $item)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>
                                    <form action="{{ route('edit.kategori') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input class="form-control" style="margin-top: -5%" type="text" name="nama" value="{{ $item->nama }}" required>
                                    </form>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm" onclick="$(this).parent().parent().prev().children().first().submit()">Simpan</button>
                                        <button class="btn btn-danger btn-sm" onclick="$(this).next().submit()">Hapus</button>
                                        <form action="{{ route('hapus.kategori') }}" method="post" style="display: none">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Tambah kategori</h4>
                    <p class="title">Pisahkan dengan [enter] untuk menambahkan banyak kategori!</p>
                </div>
                <div class="card-content">
                    <form action="{{ route('tambah.kategori') }}" method="post">
                        {{ csrf_field() }}
                        <textarea class="form-control" name="nama" rows="5"></textarea>
                        <input type="submit" value="Simpan" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection