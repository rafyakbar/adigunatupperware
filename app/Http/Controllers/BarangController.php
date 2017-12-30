<?php

namespace App\Http\Controllers;

use App\Kategori;
use foo\bar;
use Illuminate\Http\Request;
use App\Barang;
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
            return view('barang', [
                'barang' => Barang::where('dihapus', false)->orderBy('nama')->orderBy('updated_at', 'desc')->paginate($jumlah),
                'kategori' => $request->kategori,
                'no' => 0,
                'perhalaman' => $jumlah
            ]);
        }
        else{
            $kategori = str_replace('_', ' ', $request->kategori);
            if (Kategori::isAvailable($kategori)){
                return view('barang', [
                    'barang' => Barang::where('dihapus', false)->where('kategori_id', Kategori::getIdByName($kategori))->orderBy('nama')->orderBy('updated_at', 'desc')->paginate($jumlah),
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
        Barang::find($request->id)->update([
            'dihapus' => true
        ]);

        return back()->with('message', 'Berhasil dihapus!');
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

        Barang::find($request->id)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'stok' => $request->stok,
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

        return back()->with('message', 'Berhasil menambahkan '.$barang->nama.'!');
    }
}
