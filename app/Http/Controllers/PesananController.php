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

    public function tampilDetail(Request $request)
    {
        return view('detailpesanan', [
            'pesanan' => Pesanan::find($request->id)
        ]);
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
        $message = "Pesanan berhasil ditambahkan!<br>";
        $pesanan = Pesanan::create([
            'user_id' => Auth::user()->id,
            'nama_pelanggan' => $request->nama_pelanggan,
            'nohp_pelanggan' => $request->nohp_pelanggan,
            'email_pelanggan' => $request->email_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan,
            'status' => $request->status
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
            else{
                $message = $message."Stok ".$barang->nama." tidak mencukupi! (stok : ".$barang->stok.", permintaan : ".$request->jumlah[$counter].")<br>";
            }
            $counter++;
        }
        return redirect('daftar/pesanan/Semua_status/10')->with('message', rtrim($message, '<br>'));
    }
}
