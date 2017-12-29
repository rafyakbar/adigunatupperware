@extends('layouts.admin')

@section('konten')
    {{--alert--}}
    @if(session()->has('message'))
        <div class="alert alert-info">
            {!! session()->get('message') !!}
        </div>
    @endif

    <div class="btn-group">
        {{--status--}}
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                {{ str_replace('_', ' ', $status) }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('daftarpesanan', ['status' => 'Semua_status', 'perhalaman' => $perhalaman]) }}">Semua
                        status</a></li>
                @foreach(\App\Pesanan::STATUS as $item)
                    <li>
                        <a href="{{ route('daftarpesanan', ['status' => str_replace(' ', '_', $item), 'perhalaman' => $perhalaman]) }}">{{ $item }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{--pagination--}}
        <div class="btn-group">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">
                {{ $perhalaman }} pesanan per halaman
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                @for($c = 10; $c <= $pesanan->total(); $c += 10)
                    <li>
                        <a href="{{ route('daftarpesanan', ['status' => str_replace(' ', '_', $status), 'perhalaman' => $c]) }}">{{ $c }}
                            per halaman</a></li>
                @endfor
                <li>
                    <a href="{{ route('daftarpesanan', ['status' => str_replace(' ', '_', $status), 'pehalaman' => $pesanan->total()]) }}">Semua
                        pesanan</a></li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Daftar pesanan</h4>
            <p class="category">Terdapat <b>{{ $pesanan->total() }} pesanan</b> yang sesuai filter</p>
        </div>
        <div class="card-content table-responsive">
            <table class="table datatable-daftarpesanan">
                <thead>
                <tr>
                    <th class="text-center"><i class="fa fa-arrows-v fa-fw"></i>No</th>
                    <th><i class="fa fa-arrows-v fa-fw"></i>Nama Pembeli</th>
                    <th>Total</th>
                    <th><i class="fa fa-arrows-v fa-fw"></i>Status</th>
                    <th><i class="fa fa-arrows-v fa-fw"></i>Waktu</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pesanan as $item)
                    <tr @if($item->status == \App\Pesanan::STATUS[0]) class="success" @else class="warning" @endif>
                        <td class="text-center">{{ ($pesanan->currentpage() * $pesanan->perpage()) + (++$no) - $pesanan->perpage() }}</td>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td>Rp {{ number_format(\App\Pesanan::totalPembayaran($item), 0, ',', '.') }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="" class="btn btn-info btn-sm">Detail/Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="if (confirm('Apakah anda yakin ingin menghapus {{ $item->nama }}?')){ event.preventDefault();document.getElementById('hapus-{{ $item->id }}').submit();}">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $pesanan->links() }}
        </div>
    </div>
@endsection