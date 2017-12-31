<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Monitoring;
use foo\bar;
use Illuminate\Http\Request;
use App\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class BarangController extends Controller
{
    public function autocomplete(Request $request)
    {
        if ($request->has('q')){
            $keyword = $request->q;
            $result = Barang::where('stok','>',0)->whereRaw('("kode" LIKE \'%'.$keyword.'%\' OR "nama" ILIKE \'%'.$keyword.'%\')')->get();
            return response()->json($result);
        }
    }
    
    public function tampilDaftarBarang(Request $request)
    {
        $jumlah = $request->perhalaman;
        $jumlah = ($jumlah < 10) ? 10 : $jumlah;
        if ($request->kategori == 'Semua_kategori'){
            $barang = null;
            if (Auth::user()->isOwner())
                $barang = Barang::orderBy('nama')->orderBy('updated_at', 'desc')->paginate($jumlah);
            else
                $barang = Barang::where('dihapus', false)->orderBy('nama')->orderBy('updated_at', 'desc')->paginate($jumlah);
            return view('barang', [
                'barang' => $barang,
                'kategori' => $request->kategori,
                'no' => 0,
                'perhalaman' => $jumlah
            ]);
        }
        else{
            $kategori = str_replace('_', ' ', $request->kategori);
            if (Kategori::isAvailable($kategori)){
                $barang = null;
                if (Auth::user()->isOwner())
                    $barang = Barang::where('kategori_id', Kategori::getIdByName($kategori))->orderBy('nama')->orderBy('updated_at', 'desc')->paginate($jumlah);
                else
                    $barang = Barang::where('dihapus', false)->where('kategori_id', Kategori::getIdByName($kategori))->orderBy('nama')->orderBy('updated_at', 'desc')->paginate($jumlah);
                return view('barang', [
                    'barang' => $barang,
                    'kategori' => $request->kategori,
                    'no' => 0,
                    'perhalaman' => $jumlah
                ]);
            }
            return back()->with('message', 'Maaf, kategori "'.$kategori.'" tidak tersedia!');
        }
    }

    public function hapus(Request $request)
    {
        $barang = Barang::find($request->id);
        $mtr = Auth::user()->name.' menghapus barang<br>(kode : '.$barang->kode.' | nama : '.$barang->nama.' | keterangan : '.$barang->keterangan.' | harga : Rp '.$barang->harga.' | stok : '.$barang->stok.')';
        $barang->update([
            'dihapus' => true
        ]);
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'barang',
            'keterangan' => $mtr
        ]);

        return back()->with('message', 'Berhasil menghapus barang!');
    }

    public function recover(Request $request)
    {
        $barang = Barang::find($request->id);
        $mtr = Auth::user()->name.' merecover barang<br>(kode : '.$barang->kode.' | nama : '.$barang->nama.' | keterangan : '.$barang->keterangan.' | harga : Rp '.$barang->harga.' | stok : '.$barang->stok.')';
        $barang->update([
            'dihapus' => false
        ]);
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'barang',
            'keterangan' => $mtr
        ]);

        return back()->with('message', 'Berhasil merecover barang!');
    }

    public function ubahBarang(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required'
        ]);

        $mtr = '';
        $barang = Barang::find($request->id);
        $mtr = Auth::user()->name.' mengubah barang<br>(kode : '.$barang->kode.' | nama : '.$barang->nama.' | keterangan : '.$barang->keterangan.' | harga : Rp '.$barang->harga.' | stok : '.$barang->stok.')<br>menjadi<br>(kode : ';
        $barang->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'stok' => $request->stok,
        ]);
        $mtr = $mtr.$barang->kode.' | nama : '.$barang->nama.' | keterangan : '.$barang->keterangan.' | harga : Rp '.$barang->harga.' | stok : '.$barang->stok.')';
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'barang',
            'keterangan' => $mtr
        ]);

        return back()->with('message', 'Berhasil memperbarui barang!');
    }

    public function tambah(Request $request)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required'
        ]);

        $barang = Barang::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'stok' => $request->stok,
            'dihapus' => false
        ]);
        $mtr = Auth::user()->name.' menambahkan barang<br>(kode : '.$barang->kode.' | nama : '.$barang->nama.' | keterangan : '.$barang->keterangan.' | harga : Rp '.$barang->harga.' | stok : '.$barang->stok.')';
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'barang',
            'keterangan' => $mtr
        ]);

        return back()->with('message', 'Berhasil menambahkan '.$barang->nama.'!');
    }
}
