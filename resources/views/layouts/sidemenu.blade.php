<div class="logo">
    <a href="" class="simple-text">
        Adiguna Tupperware
    </a>
</div>
<div class="sidebar-wrapper">
    <ul class="nav">
        <li @if(Route::currentRouteName() == 'home') class="active" @endif>
            <a href="{{ route('home') }}">
                <i class="fa fa-home fa-fw"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li @if(Route::currentRouteName() == 'barang') class="active" @endif>
            <a href="{{ route('barang', ['kategori' => 'Semua_kategori', 'perhalaman' => 10]) }}">
                <i class="fa fa-list fa-fw"></i>
                <p>Barang</p>
            </a>
        </li>
        <li @if(Route::currentRouteName() == 'pesanan') class="active" @endif>
            <a href="{{ route('pesanan') }}">
                <i class="fa fa-cart-plus fa-fw"></i>
                <p>Tambah Pesanan</p>
            </a>
        </li>
        <li @if(Route::currentRouteName() == 'daftarpesanan') class="active" @endif>
            <a href="{{ route('daftarpesanan', ['status' => 'Semua_status', 'perhalaman' => 10]) }}">
                <i class="fa fa-handshake-o fa-fw"></i>
                <p>Daftar Pesanan</p>
            </a>
        </li>
        @if(\Illuminate\Support\Facades\Auth::user()->hak_akses == 'pemilik')
            <li @if(Route::currentRouteName() == 'pengumuman') class="active" @endif>
                <a href="{{ route('pengumuman', ['perhalaman' => 10]) }}">
                    <i class="fa fa-bullhorn fa-fw"></i>
                    <p>Pengumuman</p>
                </a>
            </li>
        @endif
        <li @if(Route::currentRouteName() == 'profil') class="active" @endif>
            <a href="{{ route('profil') }}">
                <i class="fa fa-gear fa-fw"></i>
                <p>Pengaturan</p>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out fa-fw"></i>
                <p>Keluar</p>
            </a>
        </li>
    </ul>
</div>