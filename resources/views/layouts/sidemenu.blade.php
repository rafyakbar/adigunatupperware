<div class="logo">
    <a href="" class="simple-text">
        Adiguna Tupperware
    </a>
</div>
<div class="sidebar-wrapper">
    <ul class="nav">
        <li>
            <a href="{{ route('home') }}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
        </li>
        <li @if(Route::currentRouteName() == 'barang') class="active" @endif>
            <a href="{{ route('barang', ['kategori' => 'Semua_kategori', 'perhalaman' => 10]) }}">
                <i class="material-icons">content_paste</i>
                <p>Barang</p>
            </a>
        </li>
        <li>
            <a href="">
                <i class="material-icons">attach_money</i>
                <p>Transaksi</p>
            </a>
        </li>
    </ul>
</div>