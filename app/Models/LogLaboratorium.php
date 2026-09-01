<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogLaboratorium extends Model
{
    protected $table = 'log_laboratorium';

    protected $fillable = [
        'nama',
        'log',
        'logdate',
        'username',
    ];

    protected $casts = [
        'logdate' => 'datetime',
    ];

    public $timestamps = false;
}
