<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'banks';
    protected $primaryKey = 'bank_id';
    public $timestamps = false;

    protected $fillable = [
        'nama_bank',
        'suku_bunga_dasar'
    ];
}
