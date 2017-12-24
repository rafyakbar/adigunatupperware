@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        {{ session()->get('message') }}
    @endif
    {{--form untuk ubah nama dan email--}}
    <div class="wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <!--<div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>-->
                            <div class="content">
                                <div class="row">

                                </div>
                            </div>
                            <form action="{{ route('edit.profil') }}" role="form">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" type="text" name="nama"
                                                   value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input class="form-control" type="email" name="email"
                                                   value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('edit.password') }}" role="form">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password Lama</label>
                                            <input class="form-control" type="password" name="password_lama"
                                                   minlength="6" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input class="form-control" type="password" name="password_lama"
                                                   minlength="6" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="form-control" type="password" name="password_lama"
                                                   minlength="6" required>
                                        </div>
                                    </div>
                                </div>

<<<<<<< Updated upstream
                <form class="form-horizontal" action="{{ route('edit.profil') }}" role="form" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" name="nama" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email</label>
                        <div class="col-md-6">
                            <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" action="{{ route('edit.password') }}" role="form" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password Lama</label>
                        <div class="col-md-6">
                            <input class="form-control" type="password" name="password_lama" minlength="6" required>
=======
                                <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile
                                </button>
                                <div class="clearfix"></div>
                            </form>
>>>>>>> Stashed changes
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="image">
                            <img src="assets/img/logo1.png" alt="Foto"/>
                        </div>
                        <div class="content">
                            <div class="author">
                                <a href="#">
                                    <img class="avatar border-gray" src="assets/img/faces/face-4.jpg"
                                         alt="Foto"/>

                                    <h4 class="title">Nama</h4>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <i>Jabatan : {{ Auth::user()->hak_akses }}</i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection