@extends('layouts.admin')

@section('konten')
    <div class="card">
        <div class="card-header" data-background-color="orange">
            <h4 class="title">Pengumuman!</h4>
        </div>
        <div class="card-content table-responsive">
            <table class="table datatable-general">
                <thead>
                <tr>
                    <td width="8%"><i class="fa fa-arrows-v fa-fw"></i>No</td>
                    <td width="20%"><i class="fa fa-arrows-v fa-fw"></i>Judul</td>
                    <td width="52%"><i class="fa fa-arrows-v fa-fw"></i>Isi</td>
                    <td width="20%"><i class="fa fa-arrows-v fa-fw"></i>Dibuat</td>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Pengumuman::where('tampilkan', true)->orderBy('created_at','desc')->get() as $item)
                    <tr>
                        <td>{{ ++$dump }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{!! $item->keterangan !!}</td>
                        <td>
                            {{ $item->created_at }}<br>
                            ({{ $item->created_at->diffForHumans() }})
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
