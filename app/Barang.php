<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'id', 'kategori_id', 'kode', 'dir', 'nama', 'keterangan', 'harga', 'stok', 'created_at', 'updated_at'
    ];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori', 'kategori_id')->first();
    }

    public function pesanan()
    {
        return $this->belongsToMany('App\Pesanan', 'pesanan_barang', 'barang_id', 'pesanan_id')->withPivot('harga_sekarang')->withPivot('jumlah');
    }
}
