<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    protected $table = 'wilayah';

    protected $primaryKey = 'id_wilayah';

    protected $fillable = [
        'nama_wilayah',
    ];

    public function tps(): HasMany
    {
        return $this->hasMany(Tps::class, 'id_wilayah', 'id_wilayah');
    }
}
