<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    protected $table = 'penugasan';

    protected $primaryKey = 'id_penugasan';

    protected $fillable = [
        'id_laporan',
        'id_supir',
        'id_armada',
        'waktu_ditugaskan',
        'waktu_mulai',
        'waktu_selesai',
        'keterangan_hasil',
    ];

    protected $casts = [
        'waktu_ditugaskan' => 'datetime',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function laporan()
    {
        return $this->belongsTo(
            Laporan::class,
            'id_laporan',
            'id_laporan'
        );
    }

    public function armada()
    {
        return $this->belongsTo(
            Armada::class,
            'id_armada',
            'id_armada'
        );
    }

    public function supir()
    {
        return $this->belongsTo(
            Pengguna::class,
            'id_supir',
            'id'
        );
    }
}
