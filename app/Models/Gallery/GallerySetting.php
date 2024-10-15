<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GallerySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumbnail_name',
        'thumbnail_max_w',
        'thumbnail_max_h',
        'corp_thumbnail',
        'medium_name',
        'medium_max_w',
        'medium_max_h',
        'large_name',
        'large_max_w',
        'large_max_h',
        'upload_to',
    ];

    public function getThumbnailNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getMediumNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getLargeNameAttribute($value)
    {
        return strtoupper($value);
    }
}
