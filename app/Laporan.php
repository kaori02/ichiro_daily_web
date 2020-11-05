<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporans';
    public $primaryKey = 'id_laporan';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
