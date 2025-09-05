<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservasi extends Model
{
    protected $table = 'reservasis';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'id_user',
        'kamar_id',
        'tanggal_reservasi',
        'id_voucher',
        'check_in',
        'check_out',
        'status',
        'total_harga'
    ];

    protected $casts = [
        'tanggal_reservasi' => 'datetime',
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'total_harga' => 'float',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'id_kamar');
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class, 'id_voucher', 'id_voucher');
    }

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_reservasi', 'id_reservasi');
    }
}
