<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';
    public $primaryKey = 'id_laporan';
    public $timestamps = true;

    protected $fillable = [
        'nama', 'title_laporan', 'password', 'body_laporan', 'waktu'
    ];
}
