<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'continent_id',
        'country_name',
        'code',
        'description',
        'image'
    ];

    public function continent()
    {
        return $this->belongsTo(Continents::class, 'continent_id', 'id');

    }
}
