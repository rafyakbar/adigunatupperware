@extends('layouts.admin')

@section('konten')
    {{--alert--}}
    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session()->get('message') }}
        </div>
    @endif

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
                        <a href="{{ route('barang', ['kategori' => str_replace(' ', '_', $kategori), 'perhalaman' => $c]) }}">{{ $c }}
                            per halaman</a></li>
                @endfor
                <li>
                    <a href="{{ route('barang', ['kategori' => str_replace(' ', '_', $kategori), 'perhalaman' => $barang->total()]) }}">Semua
                        barang</a></li>
            </ul>
        </div>

        {{--tambah barang--}}
        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#tambah">Tambah barang</button>
    </div>

    {{--tambah barang--}}
    <div id="tambah" class="modal fade" role="dialog" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="card">
                <div class="card-header" data-background-color="green">
                    <h4 class="modal-title">Tambah barang</h4>
                </div>
                <div class="card-content">
                    <form action="{{ route('tambah.barang') }}" method="post" id="form-tambah">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label>Kode</label>
                                    <input class="form-control" type="text" name="kode" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label>Nama</label>
                                    <input class="form-control" type="text" name="nama" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label>Kategori</label>
                                    <select name="kategori_id" class="form-control">
                                        @foreach(\App\Kategori::all() as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label>Harga</label>
                                    <input class="form-control" type="number" name="harga" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label>Stok</label>
                                    <input class="form-control" name="stok" type="number" min="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group label-floating">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan"></textarea>
                        </div>
                    </form>
                </div>
                <div class="card-content">
                    <div class="btn-group">
                        <a class="btn btn-success btn-sm"
                           onclick="event.preventDefault();document.getElementById('form-tambah').submit();">Simpan</a>
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
            <table class="table datatable-barang">
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
                    <tr @if($item->stok < 10) class="danger" @endif>
                        <td class="text-center">{{ ($barang->currentpage() * $barang->perpage()) + (++$no) - $barang->perpage() }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ (!is_null($item->kategori_id)) ? $item->kategori()->nama : '-' }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>
                            {{--form hapus--}}
                            <form id="hapus-{{ $item->id }}" action="{{ route('hapus.barang') }}" method="post"
                                  style="display: none">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                            </form>
                            <form id="recover-{{ $item->id }}" action="{{ route('recover.barang') }}" method="post"
                                  style="display: none">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                            </form>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm accordion-toggle"
                                        data-toggle="modal" data-target="#detail-{{ $item->id }}">
                                    Detail
                                </button>
                                @if(!$item->dihapus)
                                    <button class="btn btn-danger btn-sm"
                                            onclick="if (confirm('Apakah anda yakin ingin menghapus {{ $item->nama }}?')){ event.preventDefault();document.getElementById('hapus-{{ $item->id }}').submit();}">
                                        Hapus
                                    </button>
                                @endif
                                @if(\Illuminate\Support\Facades\Auth::user()->isOwner() && $item->dihapus)
                                    <button class="btn btn-success btn-sm"
                                            onclick="if (confirm('Apakah anda yakin ingin merecover {{ $item->nama }}?')){ event.preventDefault();document.getElementById('recover-{{ $item->id }}').submit();}">
                                        Recover
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="detail-{{ $item->id }}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-body">
                                <div class="modal-body">
                                    <div class="row">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-content">
                                                    <form action="{{ route('tambah.barang.stok') }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <div class="form-group label-floating">
                                                            <label>Tambahkan stok</label>
                                                            <input class="form-control" name="jumlah" type="number"
                                                                   min="1" required>
                                                        </div>
                                                        <input type="submit" value="Tambah stok"
                                                               class="btn btn-success btn-sm">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-content">
                                                    <form action="{{ route('edit.barang') }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group label-floating">
                                                                    <label>Kode</label>
                                                                    <input class="form-control" type="text"
                                                                           value="{{ $item->kode }}"
                                                                           name="kode" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group label-floating">
                                                                    <label>Nama</label>
                                                                    <input class="form-control" type="text"
                                                                           value="{{ $item->nama }}"
                                                                           name="nama" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group label-floating">
                                                                    <label>Kategori</label>
                                                                    <select name="kategori_id" class="form-control">
                                                                        @if(!is_null($item->kategori_id))
                                                                            <option value="{{ $item->kategori_id }}">{{ $item->kategori()->nama }}</option>
                                                                        @endif
                                                                        @foreach(\App\Kategori::all() as $k)
                                                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group label-floating">
                                                                    <label>Harga</label>
                                                                    <input class="form-control" type="number"
                                                                           value="{{ $item->harga }}"
                                                                           name="harga" min="0" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group label-floating">
                                                                    <label>Stok</label>
                                                                    <input class="form-control" name="stok"
                                                                           type="number"
                                                                           value="{{ $item->stok }}" min="0" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group label-floating">
                                                            <label>Keterangan</label>
                                                            <textarea class="form-control"
                                                                      name="keterangan">{{ (is_null($item->keterangan)) ? '-' : $item->keterangan }}</textarea>
                                                        </div>
                                                        <input type="submit" value="Simpan"
                                                               class="btn btn-success btn-sm">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
            <script>
                $('.accordian-body').on('show.bs.collapse', function () {
                    $(this).closest("table")
                        .find(".collapse.in")
                        .not(this)
                        .collapse('toggle')
                })
            </script>
        </div>
        <div class="card-footer">
            {{ $barang->links() }}
        </div>
    </div>
@endsection