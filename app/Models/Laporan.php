<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $primaryKey = 'id_laporan';

    public function getRouteKeyName(): string
    {
        return 'id_laporan';
    }

    protected $fillable = [
        'kategori_masalah',
        'tingkat_kondisi',
        'tingkat_urgensi',
        'keterangan',
        'status',
        'alasan_ditolak',
        'latitude',
        'longitude',
        'waktu_lapor',
        'target_waktu',
        'id_pelapor',
        'id_tps',
        'id_uptd',
    ];

    protected function casts(): array
    {
        return [
            'waktu_lapor' => 'datetime',
            'target_waktu' => 'datetime',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'id_pelapor', 'id');
    }

    public function tps(): BelongsTo
    {
        return $this->belongsTo(Tps::class, 'id_tps', 'id_tps');
    }

    public function foto(): HasMany
    {
        return $this->hasMany(FotoLaporan::class, 'id_laporan', 'id_laporan');
    }

    public function riwayat(): HasMany
    {
        return $this->hasMany(RiwayatStatus::class, 'id_laporan', 'id_laporan');
    }

    public function penugasan(): HasOne
    {
        return $this->hasOne(Penugasan::class, 'id_laporan', 'id_laporan');
    }
}
