<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendars';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'title', 'start', 'end',
    ];
}
