<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continents extends Model
{
    use HasFactory;

    protected $fillable = [
        'continent_name',
        'continent_code',
        'description',
        'image',
    ];
}
