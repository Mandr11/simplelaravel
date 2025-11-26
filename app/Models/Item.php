<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'author',
        'description',
        'tags',
        'image',
    ];

    protected $casts = [
        'tags' => 'array',
        'created_at' => 'datetime',
    ];
}
