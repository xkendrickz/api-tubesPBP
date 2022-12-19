<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrasepsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kontrasepsi',
        'jenis',
        'harga'
    ];
}
