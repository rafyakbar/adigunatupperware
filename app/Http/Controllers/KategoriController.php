<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kategori;
use App\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $kategori = Kategori::find($request->id);
        $nama = $kategori->nama;
        $kategori->update([
            'nama' => $request->nama
        ]);
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'kategori',
            'keterangan' => Auth::user()->name . ' mengubah nama kategori "'.$nama.'" menjadi "'.$kategori->nama.'"'
        ]);

        return back()->with('message', 'Berhasil menghapus data!');
    }

    public function hapus(Request $request)
    {
        $kategori = Kategori::find($request->id);
        $nama = $kategori->nama;
        $kategori->delete();
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'kategori',
            'keterangan' => Auth::user()->name.' menghapus kategori "'.$nama.'"'
        ]);

        return back()->with('message', 'Berhasil menghapus kategori!');
    }

    public function tambah(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required'
        ]);

        $c = 0;
        $nama = '';
        foreach (explode(PHP_EOL, $request->nama) as $item) {
            Kategori::create([
                'nama' => $item
            ]);
            $nama = $item.', '.$nama;
            $c++;
        }
        $nama = rtrim($nama, ', ');
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'kategori',
            'keterangan' => Auth::user()->name.' menambahkan kategori "'.$nama.'"'
        ]);

        return back()->with('message', 'Berhasil menambahkan ' . $c . ' kategori!');
    }
}
