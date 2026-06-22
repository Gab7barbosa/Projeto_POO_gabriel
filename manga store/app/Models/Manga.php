<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'editora',
        'preco',
        'estoque',
        'sinopse',
        'capa',
    ];
}
