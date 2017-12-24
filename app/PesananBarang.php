<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananBarang extends Model
{
    protected $table = 'pesanan_barang';

    protected $fillable = [
        'pesanan_id', 'barang_id', 'jumlah'
    ];
}
