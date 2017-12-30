<?php

namespace App\Http\Controllers;

use App\Monitoring;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function tampil(Request $request)
    {
        $request->perhalaman = ($request->perhalaman < 10) ? 10 : $request->perhalaman;
        $menu = $request->menu;
        if ($menu == 'Semua_menu'){
            return view('monitoring', [
                'monitoring' => Monitoring::orderBy('created_at', 'desc')->paginate($request->perhalaman),
                'perhalaman' => $request->perhalaman,
                'menu' => $menu,
                'no' => 0
            ]);
        }
        $menu = strtolower($menu);
        if (Monitoring::cekMenu($menu)){
            return view('monitoring', [
                'monitoring' => Monitoring::where('menu', $menu)->orderBy('created_at', 'desc')->paginate($request->perhalaman),
                'perhalaman' => $request->perhalaman,
                'menu' => $menu,
                'no' => 0
            ]);
        }

        return back()->with('message', 'Tidak ada menu '.$menu.'!');
    }

    public function hapus(Request $request)
    {
        Monitoring::find($request->id)->delete();

        return back()->with('message', 'Berhasil menghapus!');
    }
}
