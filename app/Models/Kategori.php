<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // 1 Kategori punya Banyak Barang (hasMany)
    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
