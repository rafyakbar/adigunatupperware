<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <p class="navbar-brand">
                @if(Route::currentRouteName() == 'profil')
                    Profil
                @elseif(Route::currentRouteName() == 'home')
                    Dashboard
                @elseif(Route::currentRouteName() == 'pesanan')
                    Tambah pesanan
                @elseif(Route::currentRouteName() == 'daftarpesanan')
                    Daftar pesanan
                @elseif(Route::currentRouteName() == 'pengumuman')
                    Pengumuman
                @elseif(Route::currentRouteName() == 'detailpesanan')
                    Pesanan yang dibeli oleh <b>{{ $pesanan->nama_pelanggan }}</b>
                @elseif(Route::currentRouteName() == 'barang')
                    Barang
                @elseif(Route::currentRouteName() == 'pegawai')
                    Pegawai
                @endif
            </p>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ Auth::user()->name }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('profil') }}">Pengaturan</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>