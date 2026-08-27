<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produsen extends Model
{
    protected $table = 'produsen';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = ['id', 'nama', 'alamat'];
}
