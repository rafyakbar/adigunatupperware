@extends('layouts.admin')

@section('konten')
<div class="card">
    @foreach(\App\Pengumuman::all() as $item)
        <div class="alert alert-warning">
            {{ $item->keterangan }}
            <br>
            {{ $item->updated_at->diffForHumans() }}
        </div>
    @endforeach
</div>
@endsection
