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
        <li>
            <a href="">
                <i class="fa fa-cart-plus fa-fw"></i>
                <p>Pesanan</p>
            </a>
        </li>
        <li>
            <a href="">
                <i class="fa fa-handshake-o fa-fw"></i>
                <p>Transaksi</p>
            </a>
        </li>
    </ul>
</div>