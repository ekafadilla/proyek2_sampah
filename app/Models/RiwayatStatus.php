<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatStatus extends Model
{
    protected $table = 'riwayat_status';
    protected $primaryKey = 'id_riwayat';

    protected $fillable = [
        'id_laporan',
        'status',
        'catatan',
        'waktu_status',
        'id_pengguna',
    ];

    public function laporan()
    {
        return $this->belongsTo(
            Laporan::class,
            'id_laporan',
            'id_laporan'
        );
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id');
    }
}
