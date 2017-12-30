<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'id', 'judul', 'keterangan', 'tampilkan', 'created_at', 'update_at'
    ];

}
