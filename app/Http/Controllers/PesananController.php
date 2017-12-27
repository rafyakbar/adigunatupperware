<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function tampilForm()
    {
        return view('tambahpesanan');
    }

    public function tampilDaftar(Request $request)
    {
        $request->status = str_replace('_', ' ', $request->status);
        if ($request->status != "Semua status" && !Pesanan::cekStatus($request->status)){
            return back()->with('message', 'Maaf, tidak ada status pesanan "'.$request->status.'"!');
        }
        $jumlah = $request->perhalaman;
        $jumlah = ($jumlah < 10) ? 10 : $jumlah;
        $pesanan = ($request->status == "Semua status") ? Pesanan::orderBy('created_at', 'desc') : Pesanan::where('status', $request->status);
        return view('daftarpesanan', [
            'pesanan' => $pesanan->paginate($jumlah),
            'status' => $request->status,
            'perhalaman' => $jumlah,
            'no' => 0
        ]);
    }

    public function tambah(Request $request)
    {
        $pesanan = Pesanan::create([
            'user_id' => Auth::user()->id,
            'nama_pelanggan' => $request->nama_pelanggan,
            'nohp_pelanggan' => $request->nohp_pelanggan,
            'email_pelanggan' => $request->email_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan
        ]);
        $counter = 0;
        foreach ($request->kode as $item){
            $barang = Barang::find($item);
            if ($barang->stok >= $request->jumlah[$counter]){
                $pesanan->barang()->attach($barang, [
                    'harga_sekarang' => $barang->harga,
                    'jumlah' => $request->jumlah[$counter]
                ]);
                $barang->update([
                    'stok' => $barang->stok - $request->jumlah[$counter]
                ]);
            }
            $counter++;
        }
    }
}
