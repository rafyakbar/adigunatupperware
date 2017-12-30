<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function tampilForm()
    {
        return view('kategori', [
            'kategori' => Kategori::orderBy('nama')->get(),
            'no' => 0
        ]);
    }

    public function ubah(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required'
        ]);

        Kategori::find($request->id)->update([
            'nama' => $request->nama
        ]);

        return back()->with('message', 'Berhasil menghapus data!');
    }

    public function hapus(Request $request)
    {
        Kategori::find($request->id)->delete();

        return back()->with('message', 'Berhasil menghapus kategori!');
    }

    public function tambah(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required'
        ]);

        $c = 0;
        foreach (explode(PHP_EOL, $request->nama) as $item){
            Kategori::create([
                'nama' => $item
            ]);
            $c++;
        }

        return back()->with('message', 'Berhasil menambahkan '.$c.' kategori!');
    }
}
