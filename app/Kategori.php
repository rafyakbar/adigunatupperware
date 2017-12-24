<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    public $timestamps = false;

    protected $fillable = [
        'id', 'nama'
    ];

    public function barang()
    {
        return $this->hasMany('App\Barang')->get();
    }

    public static function getIdByName($name)
    {
        return Kategori::where('nama', '=', $name)->first()->id;
    }

    public static function isAvailable($name)
    {
        foreach (Kategori::all() as $item)
            if ($item->nama === $name)
                return true;
        return false;
    }
}
