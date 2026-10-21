<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armada extends Model
{
    protected $table = 'armada';

    protected $primaryKey = 'id_armada';

    protected $fillable = [
        'plat_nomor',
        'jenis_armada',
        'status_tersedia',
    ];

    public function penugasan()
    {
        return $this->hasMany(
            Penugasan::class,
            'id_armada',
            'id_armada'
        );
    }
}
