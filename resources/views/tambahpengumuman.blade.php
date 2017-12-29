@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="card">
        <form method="post" action="{{ route('tambah.pengumuman') }}">
            {{ csrf_field() }}
            <label>Tulis Pengumuman</label>
            <textarea class="form-control" name="keterangan"></textarea>
            <input type="submit" class="btn btn-behance">
        </form>
    </div>
@endsection