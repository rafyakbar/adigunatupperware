@extends('layouts.admin')

@section('konten')
    <div class="btn-group">
        {{--kategori barang--}}
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                {{ str_replace('_', ' ', $kategori) }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('barang', ['kategori' => 'Semua_kategori', 'perhalaman' => $perhalaman]) }}">Semua
                        kategori</a></li>
                @foreach(\App\Kategori::all() as $item)
                    <li>
                        <a href="{{ route('barang', ['kategori' => str_replace(' ', '_', $item->nama), 'perhalaman' => $perhalaman]) }}">{{ $item->nama }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{--pagination--}}
        <div class="btn-group">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">
                {{ $perhalaman }} barang per halaman
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                @for($c = 10; $c <= $barang->total(); $c += 10)
                    <li>
                        <a href="{{ route('barang', ['kategori' => str_replace(' ', '_', $kategori), 'perpage' => $c]) }}">{{ $c }}
                            per halaman</a></li>
                @endfor
                <li>
                    <a href="{{ route('barang', ['kategori' => str_replace(' ', '_', $kategori), 'perpage' => $barang->total()]) }}">Semua
                        barang</a></li>
            </ul>
        </div>

        {{--tambah barang--}}
        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#tambah">Tambah barang</button>
    </div>

    {{--alert--}}
    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session()->get('message') }}
        </div>
    @endif

    {{--tambah barang--}}
    <div id="tambah" class="modal fade" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="modal-title">Tambah barang</h4>
                </div>
                <div class="card-content">
                    <div style="height: 325px;overflow: auto">
                        <form action="{{ route('tambah.barang') }}" method="post" id="form-tambah">
                            {{ csrf_field() }}
                            <div class="form-group label-floating">
                                <label>Kode</label>
                                <input class="form-control" type="number" name="kode" required>
                            </div>
                            <div class="form-group label-floating">
                                <label>Nama</label>
                                <input class="form-control" type="text" name="nama" required>
                            </div>
                            <div class="form-group label-floating">
                                <label>Kategori</label>
                                <select name="kategori_id" class="form-control">
                                    @foreach(\App\Kategori::all() as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <label>Harga</label>
                                <input class="form-control" type="number" name="harga" min="0" required>
                            </div>
                            <div class="form-group label-floating">
                                <label>Stok</label>
                                <input class="form-control" name="stok" type="number" min="0" required>
                            </div>
                            <div class="form-group label-floating">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-content">
                    <div class="btn-group">
                        <a class="btn btn-success btn-sm" onclick="event.preventDefault();document.getElementById('form-tambah').submit();">Simpan</a>
                        <a class="btn btn-danger btn-sm" data-dismiss="modal">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Daftar barang</h4>
            <p class="category">Terdapat <b>{{ $barang->total() }} barang</b> yang sesuai filter</p>
        </div>
        <div class="card-content table-responsive">
            <table class="table use-datatable">
                <thead>
                <tr>
                    <th class="text-center"><i class="fa fa-arrows-v fa-fw"></i>No</th>
                    <th><i class="fa fa-arrows-v fa-fw"></i>Kode</th>
                    <th><i class="fa fa-arrows-v fa-fw"></i>Nama</th>
                    <th><i class="fa fa-arrows-v fa-fw"></i>Kategori</th>
                    <th><i class="fa fa-arrows-v fa-fw"></i>Stok</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($barang as $item)
                    <tr>
                        <td class="text-center">{{ ($barang->currentpage() * $barang->perpage()) + (++$no) - $barang->perpage() }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kategori()->nama }}</td>
                        {{--<td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>--}}
                        <td>{{ $item->stok }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit-{{ $item->id }}">Detail / Edit
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="if (confirm('Apakah anda yakin ingin menghapus {{ $item->nama }}?')){ event.preventDefault();document.getElementById('hapus-{{ $item->id }}').submit();}">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{--form hapus--}}
                    <form id="hapus-{{ $item->id }}" action="{{ route('hapus.barang') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $item->id }}">
                    </form>

                    {{--form edit dengan modal--}}
                    <div id="edit-{{ $item->id }}" class="modal fade" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);">
                        <div class="modal-dialog">
                            <div class="card">
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="modal-title">Edit <b><i>{{ $item->nama }}</i></b></h4>
                                    <p class="category">Telah diedit {{ $item->updated_at->diffForHumans() }}</p>
                                </div>
                                <div class="card-content">
                                    <div style="height: 325px;overflow: auto">
                                        <form action="{{ route('edit.barang') }}" method="post" id="form-edit-{{ $item->id }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <div class="form-group label-floating">
                                                <label>Kode</label>
                                                <input class="form-control" type="number" value="{{ $item->kode }}" name="kode" required>
                                            </div>
                                            <div class="form-group label-floating">
                                                <label>Nama</label>
                                                <input class="form-control" type="text" value="{{ $item->nama }}" name="nama" required>
                                            </div>
                                            <div class="form-group label-floating">
                                                <label>Kategori</label>
                                                <select name="kategori_id" class="form-control">
                                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori()->nama }}</option>
                                                    @foreach(\App\Kategori::all() as $k)
                                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group label-floating">
                                                <label>Harga</label>
                                                <input class="form-control" type="number" value="{{ $item->harga }}" name="harga" min="0" required>
                                            </div>
                                            <div class="form-group label-floating">
                                                <label>Stok</label>
                                                <input class="form-control" name="stok" type="number" value="{{ $item->stok }}" min="0" required>
                                            </div>
                                            <div class="form-group label-floating">
                                                <label>Keterangan</label>
                                                <textarea class="form-control" name="keterangan">{{ (is_null($item->keterangan)) ? '-' : $item->keterangan }}</textarea>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-sm" onclick="event.preventDefault();document.getElementById('form-edit-{{ $item->id }}').submit();">Simpan</a>
                                        <a class="btn btn-danger btn-sm" data-dismiss="modal">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $barang->links() }}
        </div>
    </div>
@endsection