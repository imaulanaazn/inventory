<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBarangSetengahJadi extends Model
{
    protected $table = 'stok_barang_setengah_jadi';

    protected $fillable = [
        'brg_setengah_jadi_id',
        'jumlah',
        'jumlah_masuk',
        'jumlah_keluar',
        'created_at',
        'updated_at',
    ];

    public function brg_setengah_jadi()
    {
        return $this->belongsTo(BarangSetengahJadi::class, 'brg_setengah_jadi_id', 'id');
    }
}
