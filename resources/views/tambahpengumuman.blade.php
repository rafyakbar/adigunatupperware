@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header" data-background-color="orange">
            <h4 class="title">Tulis Pengumuman</h4>
        </div>
        <div class="card-content">
            <form method="post" action="{{ route('tambah.pengumuman') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul" required>
                </div>
                <div class="form-group">
                    <label>Isi</label>
                    <textarea class="form-control use-tinymce" name="keterangan"></textarea>
                </div>
                <input type="submit" class="btn btn-behance">
            </form>
        </div>
    </div>
@endsection