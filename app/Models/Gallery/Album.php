<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Album extends Model
{
    use HasFactory;


    protected $fillable = ['name'];

    public function getNameAttribute($value)
    {
        return Str::title($value);
    }
}
