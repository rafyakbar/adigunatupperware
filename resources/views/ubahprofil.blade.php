@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">General</h4>
                    <p class="category">Isi data berikut sesuai dengan identitas asli anda!</p>
                </div>
                <div class="card-content">
                    <form action="{{ route('edit.profil') }}" role="form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group label-floating">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="nama"
                                   value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group label-floating">
                            <label>No HP</label>
                            <input class="form-control" type="number" name="nohp"
                                   value="{{ Auth::user()->nohp }}">
                        </div>
                        <div class="form-group label-floating">
                            <label for="exampleInputEmail1">Email</label>
                            <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <input type="submit" value="Simpan" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" data-background-color="orange">
                    <h4 class="title">Password</h4>
                    <p class="category">Perbarui keamanan akun anda!</p>
                </div>
                <div class="card-content">
                    <form action="{{ route('edit.password') }}" role="form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group label-floating">
                            <label>Password Lama</label>
                            <input class="form-control" type="password" name="password_lama"
                                   minlength="6" required>
                        </div>
                        <div class="form-group label-floating">
                            <label>Password Baru</label>
                            <input class="form-control" type="password" name="password_lama"
                                   minlength="6" required>
                        </div>
                        <div class="form-group label-floating">
                            <label>Konfirmasi Password</label>
                            <input class="form-control" type="password" name="password_lama"
                                   minlength="6" required>
                        </div>
                        <input type="submit" value="Simpan" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection