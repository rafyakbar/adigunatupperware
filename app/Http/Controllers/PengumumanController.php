<?php

namespace App\Http\Controllers;

use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengumumanController extends Controller
{
    public function tampilTambahForm(){
        return view('tambahpengumuman');
    }

    public function tambah(Request $request)
    {
        Pengumuman::create([
            'keterangan' => $request->keterangan
        ]);

        return back()->with('message', 'Berhasil menambahkan pengumuman');

    }
}
