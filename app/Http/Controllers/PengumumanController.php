<?php

namespace App\Http\Controllers;

use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengumumanController extends Controller
{
    public function tampilForm(Request $request){
        $request->perhalaman = ($request->perhalaman < 10) ? 10 : $request->perhalaman;

        return view('pengumuman',[
            'pengumuman' => Pengumuman::orderBy('created_at', 'desc')->paginate($request->perhalaman),
            'perhalaman' => $request->perhalaman,
            'no' => 0
        ]);
    }

    public function tambah(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'keterangan' => 'required'
        ]);

        $request->tampilkan = ($request->tampilkan) ? true : false;

        Pengumuman::create([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'tampilkan' => $request->tampilkan,
        ]);

        return back()->with('message', 'Berhasil menambahkan pengumuman!');
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'keterangan' => 'required'
        ]);

        $request->tampilkan = ($request->tampilkan) ? true : false;

        Pengumuman::find($request->id)->update([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'tampilkan' => $request->tampilkan,
        ]);

        return back()->with('message', 'Berhasil mengedit pengumuman!');
    }

    public function hapus(Request $request)
    {
        Pengumuman::find($request->id)->delete();

        return back()->with('message', 'Berhasil menghapus pengumuman!');
    }
}
