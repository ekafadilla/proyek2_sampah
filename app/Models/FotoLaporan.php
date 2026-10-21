<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoLaporan extends Model
{
    protected $table = 'foto_laporan';
    protected $primaryKey = 'id_foto';

    protected $fillable = [
        'id_laporan',
        'jenis_foto',
        'nama_file',
        'waktu_unggah',
    ];

    public function laporan()
    {
        return $this->belongsTo(
            Laporan::class,
            'id_laporan',
            'id_laporan'
        );
    }
}
