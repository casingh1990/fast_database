<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Visit class
 */
class Visit extends Model
{
    use HasFactory;

    protected $casts = [
        'selection' => 'array'
    ];
}
