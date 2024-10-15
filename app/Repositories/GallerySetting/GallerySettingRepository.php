<?php

namespace App\Repositories\GallerySetting;

use App\Models\Gallery\GallerySetting;

class GallerySettingRepository implements GallerySettingInterface
{

    public function index()
    {
        return GallerySetting::first();
    }

    public function update($id, $data)
    {
        return GallerySetting::find($id)->update($data);
    }
}
