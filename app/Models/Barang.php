<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // 1 Barang hanya milik 1 Kategori (belongsTo)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
