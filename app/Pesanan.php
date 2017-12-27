<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    const STATUS = [
        'Lunas',
        'Belum lunas'
    ];

    protected $table = 'pesanan';

    protected $fillable = [
        'id', 'user_id', 'nama_pelanggan', 'nohp_pelanggan', 'email_pelanggan', 'alamat_pelanggan', 'status', 'created_at', 'updates_at'
    ];

    public function barang()
    {
        return $this->belongsToMany('App\Barang', 'pesanan_barang', 'pesanan_id', 'barang_id')->withPivot('harga_sekarang')->withPivot('jumlah');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id')->first();
    }

    public static function cekStatus($status){
        foreach (Pesanan::STATUS as $item){
            if ($item == $status){
                return true;
            }
        }
        return false;
    }

    public static function totalPembayaran($pesanan){
        $total = 0;
        foreach ($pesanan->barang as $item){
            $total = $total + ($item->pivot->jumlah * $item->pivot->harga_sekarang);
        }
        return $total;
    }
}
