@extends('layouts.admin')

@section('konten')
    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="btn-group">
        {{--pagination--}}
        <div class="btn-group">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">
                {{ $perhalaman }} per halaman
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                @for($c = 10; $c <= $pengumuman->total(); $c += 10)
                    <li>
                        <a href="{{ route('pengumuman', ['perhalaman' => $c]) }}">{{ $c }} per halaman</a></li>
                @endfor
                <li>
                    <a href="{{ route('pengumuman', ['perhalaman' => $pengumuman->total()]) }}">Semua pengumuman</a></li>
            </ul>
        </div>

        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#tambah-pengumuman">Tambah pengumuman</button>
    </div>

    <div class="card">
        <div class="card-header" data-background-color="orange">
            <h4>Daftar pengumuman</h4>
            <p>Terdapat {{ $pengumuman->total() }} pengumuman sesuai filter</p>
        </div>
        <div class="card-content table-responsive">
            <table class="table datatable-pengumuman">
                <thead>
                <tr>
                    <td width="8%"><i class="fa fa-arrows-v fa-fw"></i>No</td>
                    <td width="30%"><i class="fa fa-arrows-v fa-fw"></i>Judul</td>
                    <td width="12%"><i class="fa fa-arrows-v fa-fw"></i>Ditampilkan</td>
                    <td width="30%"><i class="fa fa-arrows-v fa-fw"></i>Dibuat</td>
                    <td width="20%">Aksi</td>
                </tr>
                </thead>
                <tbody>
                @foreach($pengumuman as $item)
                    <tr>
                        <td>{{ ($pengumuman->currentpage() * $pengumuman->perpage()) + (++$no) - $pengumuman->perpage() }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ ($item->tampilkan) ? 'Ya' : 'Tidak' }}</td>
                        <td>{{ $item->created_at }} ({{ $item->created_at->diffForHumans() }})</td>
                        <td>
                            <form id="hapus-{{ $item->id }}" action="{{ route('hapus.pengumuman') }}" method="post" style="display: none">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                            </form>
                            <div class="btn-group">
                                <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#edit-{{ $item->id }}">Detail/Edit</button>
                                <a href="{{ route('hapus.pengumuman') }}" class="btn btn-danger btn-sm" onclick="if (confirm('Apakah anda yakin ingin menghapus {{ $item->judul }}?')){ event.preventDefault();document.getElementById('hapus-{{ $item->id }}').submit();}">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <div id="edit-{{ $item->id }}" class="modal fade" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);">
                        <div class="modal-dialog modal-lg">
                            <div class="card">
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">Edit "{{ $item->judul }}"</h4>
                                </div>
                                <div class="card-content">
                                    <form method="post" action="{{ route('edit.pengumuman') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input type="text" class="form-control" name="judul" value="{{ $item->judul }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Isi</label>
                                            <textarea class="form-control use-tinymce" name="keterangan">{{ $item->keterangan }}</textarea>
                                        </div>
                                        <input type="checkbox" name="tampilkan" @if($item->tampilkan) checked @endif> Tampilkan pada dashboard pegawai<br>
                                        <div class="btn-group">
                                            <input type="submit" class="btn btn-success">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="tambah-pengumuman" class="modal fade" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-lg">
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
                        <input type="checkbox" name="tampilkan" checked> Tampilkan pada dashboard pegawai<br>
                        <div class="btn-group">
                            <input type="submit" class="btn btn-success">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection