@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        {{ session()->get('message') }}
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" data-background-color="green">
                    General
                </div>
                <div class="card-content">
                    <form action="{{ route('edit.profil') }}" role="form">
                        {{ csrf_field() }}
                        <div class="form-group label-floating">
                            <label>Username</label>
                            <input class="form-control" type="text" name="nama"
                                   value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group label-floating">
                            <label for="exampleInputEmail1">Email address</label>
                            <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection