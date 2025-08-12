<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voucher extends Model
{
    protected $table = 'vouchers';
    protected $primaryKey = 'id_voucher';

    protected $fillable = [
        'kode',
        'deskripsi',
        'jumlah',
        'min_transaksi',
        'tanggal_berlaku',
        'status_voucher'
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'min_transaksi' => 'float',
        'tanggal_berlaku' => 'datetime',
    ];

    public function reservasis(): HasMany
    {
        return $this->hasMany(Reservasi::class, 'id_voucher', 'id_voucher');
    }
}