<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_author',
        'album_id',
        'post_date',
        'file_name',
        'title',
        'alternative_text',
        'caption',
        'description',
        'mime_type',
        'url',
        'edit_url'
    ];

    public function getUrlAttribute($value): string
    {
        if ($this->edit_url != null) {
            return $this->attributes['url'] = $this->edit_url;
        } else {
            return $this->attributes['url'] = $value;
        }
    }


    protected $appends = ['dimensions'];


    public function getDimensionsAttribute($value): string
    {
        $imageExtension = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($this->attributes['mime_type'], $imageExtension)) {
            return $this->attributes['dimensions'] = "Not Applicable";
        } else {
            $image = str_replace(url('/'), '', $this->url);
            $image = public_path($image);
            list($width, $height) = getimagesize($image);
            return $this->attributes['dimensions'] = $width . 'x' . $height;
        }
    }


    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
