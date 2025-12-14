<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    protected $table = 'simulations';
    protected $primaryKey = 'simulation_id';
    public $timestamps = false;

    protected $fillable = [
        'simulasi_id',
        'user_id',
        'nominal_deposito',
        'jangka_waktu_bulan',
        'bunga_diterima',
        'total_akhir',
        'waktu_simulasi',
    ];
}
