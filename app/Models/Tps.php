<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    protected $table = 'tps';

    protected $primaryKey = 'id_tps';

    protected $fillable = [
        'nama_tps',
        'alamat',
        'latitude',
        'longitude',
        'id_wilayah',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function wilayah()
    {
        return $this->belongsTo(
            Wilayah::class,
            'id_wilayah',
            'id_wilayah'
        );
    }
}