<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'tanggal',
        'account_id',
        'keterangan',
        'nominal',
        'jenis_transaksi',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}