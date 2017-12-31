<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Monitoring;
use App\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function tampilForm()
    {
        return view('tambahpesanan');
    }

    public function tampilKeuangan(Request $request)
    {
        try{
            Carbon::parse($request->akhir);
            Carbon::parse($request->awal);
        }
        catch (\Exception $exception){
            return redirect()->route('keuangan', ['awal' => \Illuminate\Support\Carbon::today()->startOfMonth()->toDateString(), 'akhir' => \Illuminate\Support\Carbon::today()->toDateString()]);
        }

        $pesanan = Pesanan::where('created_at', '>=', $request->awal)->where('created_at', '<=', $request->akhir)->orderBy('created_at', 'desc')->get();
        $lunas = 0;
        $belumlunas = 0;
        foreach ($pesanan as $item){
            $pembayaran = Pesanan::totalPembayaran($item);
            $lunas = ($item->status == 'Lunas') ? ($lunas + $pembayaran) : $lunas;
            $belumlunas = ($item->status == 'Belum lunas') ? ($belumlunas + $pembayaran) : $belumlunas;
        }

        return view('keuangan', [
            'awal' => $request->awal,
            'akhir' => $request->akhir,
            'pesanan' => $pesanan,
            'no' => 0,
            'lunas' => $lunas,
            'belumlunas' => $belumlunas,
        ]);
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
        $pesanan = ($request->status == "Semua status") ? Pesanan::orderBy('created_at', 'desc') : Pesanan::where('status', $request->status)->orderBy('created_at', 'desc');

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
                $message = $message."<b>Stok ".$barang->nama." tidak mencukupi! (stok : ".$barang->stok.", permintaan : ".$request->jumlah[$counter].")</b><br>";
            }
            $counter++;
        }

        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'pesanan',
            'keterangan' => Auth::user()->name.' melayani pesanan <b>'.$request->nama_pelanggan.'</b>'
        ]);

        return redirect('pesanan/detail/'.$pesanan->id)->with('message', rtrim($message, '<br>'));
    }

    public function hapus(Request $request)
    {
        $pesanan = Pesanan::find($request->id);
        $nama = $pesanan->nama_pelanggan;
        foreach ($pesanan->barang as $item){
            $item->update([
                'stok' => $item->stok + $item->pivot->jumlah,
            ]);
            $pesanan->barang()->detach($item);
        }
        $pesanan->delete();
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'pesanan',
            'keterangan' => Auth::user()->name.' menghapus pesanan yang dipesanan oleh <b>'.$nama.'</b>'
        ]);

        return back()->with('message', 'Pesanan berhasil dibatalkan/dihapus!');
    }

    public function hapusBarang(Request $request)
    {
        $pesanan = Pesanan::find($request->pesanan_id);
        $barang = Barang::find($request->barang_id);
        $jumlah = $pesanan->barang->find($barang->id)->pivot->jumlah;
        $stokSebelum = 0;

        $barang->update([
            'stok' => ($stokSebelum = $barang->stok) + $jumlah
        ]);

        $pesanan->barang()->detach($barang);
        Monitoring::create([
            'user_id' => Auth::user()->id,
            'menu' => 'pesanan',
            'keterangan' => Auth::user()->name.' menghapus barang ('.$barang->nama.') pada pesanan yang dipesanan oleh <b>'.$pesanan->nama_pelanggan.'</b>'
        ]);

        return back()->with('message', 'Berhasil membatalkan '.$barang->nama.'! (stok sebelum : '.$stokSebelum.', stok sesudah : '.$barang->stok.')');
    }
}
