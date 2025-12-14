<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    protected $table = 'simulations';
    protected $primaryKey = 'simulasi_id';
    public $timestamps = false;

    protected $fillable = [
        'simulasi_id',
        'user_id',
        'bank_id',
        'nominal_deposito',
        'jangka_waktu_bulan',
        'bunga_diterima',
        'total_akhir',
        'waktu_simulasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'bank_id');
    }
}
