<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama',
        'kategori',
        'harga',
        'stok',
    ];

    protected $casts = [
        'harga' => 'integer',
        'stok' => 'integer',
    ];
}
