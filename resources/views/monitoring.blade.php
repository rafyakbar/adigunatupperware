@extends('layouts.admin')

@section('konten')
    {{--alert--}}
    @if(session()->has('message'))
        <div class="alert alert-info">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="btn-group">
        {{--menu--}}
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                {{ str_replace('_', ' ', $menu) }}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('monitoring', ['menu' => 'Semua_menu', 'perhalaman' => $perhalaman]) }}">Semua
                        menu</a></li>
                @foreach(\App\Monitoring::MENU as $item)
                    <li>
                        <a href="{{ route('monitoring', ['menu' => $item, 'perhalaman' => $perhalaman]) }}">{{ ucwords($item) }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{--pagination--}}
        <div class="btn-group">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">
                {{ $perhalaman }} data per halaman
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                @for($c = 10; $c <= $monitoring->total(); $c += 10)
                    <li>
                        <a href="{{ route('monitoring', ['menu' => $menu, 'perhalaman' => $c]) }}">{{ $c }}data per
                            halaman</a></li>
                @endfor
                <li>
                    <a href="{{ route('monitoring', ['menu' => $menu, 'perhalaman' => $monitoring->total()]) }}">Semua
                        data</a></li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-background-color="red">
            <h4 class="title">Daftar monitoring</h4>
            <p class="category">Terdapat total {{ $monitoring->total() }} kegiatan sesui filter</p>
        </div>
        <div class="card-content table-responsive">
            <table class="table datatable-monitoring">
                <thead>
                <tr>
                    <td width="8%"><i class="fa fa-arrows-v fa-fw"></i>No</td>
                    <td width="10%"><i class="fa fa-arrows-v fa-fw"></i>Menu</td>
                    <td><i class="fa fa-arrows-v fa-fw"></i>Keterangan</td>
                    <td>Aksi</td>
                </tr>
                </thead>
                <tbody>
                @foreach($monitoring as $item)
                    <tr>
                        <td>{{ ($monitoring->currentpage() * $monitoring->perpage()) + (++$no) - $monitoring->perpage() }}</td>
                        <td>{{ $item->menu }}</td>
                        <td>
                            <p align="justify">{!! $item->keterangan !!}</p>
                            <p><b>Pegawai yang melakukan kegiatan ini : {{ \App\User::find($item->user_id)->name }}</b></p>
                            <p><b>{{ $item->created_at->diffForHumans() }}</b></p>
                        </td>
                        <td>
                            <form action="{{ route('hapus.monitoring') }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $monitoring->links() }}
        </div>
    </div>
@endsection