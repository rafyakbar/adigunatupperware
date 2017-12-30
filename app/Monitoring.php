<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $table = 'monitoring';

    const MENU = [
        'barang', 'pesanan', 'kategori'
    ];

    protected $fillable = [
        'id', 'user_id', 'menu', 'keterangan', 'created_at', 'updated_at'
    ];

    public static function cekMenu($nama)
    {
        foreach (Monitoring::MENU as $item){
            if ($nama == $item){
                return true;
            }
        }
        return false;
    }
}
