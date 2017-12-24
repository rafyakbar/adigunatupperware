<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $table = 'tabel';

    protected $fillable = [
        'id', 'nama', 'keterangan', 'created_at', 'updated_at'
    ];
}
