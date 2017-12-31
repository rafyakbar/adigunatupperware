@extends('layouts.admin')

@section('konten')
    {{--alert--}}
    <div class="alert alert-info">
        Jika anda menghapus pegawai, maka informasi pelayan yang dilayani oleh pegawai tersebut akan hilang namun masih bisa dilihat pada menu "Monitoring"
        @if(session()->has('message'))
            <br>
            {{ session()->get('message') }}
        @endif
    </div>

    <div class="btn-group">
        <div class="btn-group">
            <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">
                {{ $perhalaman }} data per halaman
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                @for($c = 10; $c <= $pegawai->total(); $c += 10)
                    <li>
                        <a href="{{ route('pegawai', ['perhalaman' => $c]) }}">{{ $c }}data per halaman</a></li>
                @endfor
                <li>
                    <a href="{{ route('pegawai', ['perhalaman' => $pegawai->total()]) }}">Semua data</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Daftar pegawai</h4>
                    <p class="category">Terdapat {{ $pegawai->total() }} pegawai</p>
                </div>
                <div class="card-content table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Email</td>
                            <td>No HP</td>
                            <td>Aksi</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pegawai as $item)
                            <tr>
                                <td>{{ ($pegawai->currentpage() * $pegawai->perpage()) + (++$no) - $pegawai->perpage() }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->nohp }}</td>
                                <td>
                                    <form action="{{ route('hapus.pegawai') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $pegawai->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="title">Tambah pegawai</h4>
                    <p class="category">Isi data pegawai dibawah ini dengan benar</p>
                </div>
                <div class="card-content">
                    <form action="{{ route('tambah.pegawai') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>No HP</label>
                            <input class="form-control" type="number" name="nohp" minlength="10" required>
                        </div>
                        <div class="form-group">
                            <label>Password (password default : secret)</label>
                            <input class="form-control" type="password" value="secret" name="password" required>
                        </div>
                        <input class="btn btn-success" type="submit" value="Simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection