<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $table = 'monitoring';

    protected $fillable = [
        'id', 'nama', 'keterangan', 'created_at', 'updated_at'
    ];
}
