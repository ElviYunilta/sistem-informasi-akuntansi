<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'jenis',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}