<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery\GallerySetting;

class GallerySettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gallerySettingData = [
            'thumbnail_name' => 'thumbnail',
            'thumbnail_max_w' => 150,
            'thumbnail_max_h' => 150,
            'corp_thumbnail' => true,
            'medium_name' => 'medium',
            'medium_max_w' => 300,
            'medium_max_h' => 300,
            'large_name' => 'large',
            'large_max_w' => 600,
            'large_max_h' => 600,
            'upload_to' => true,
        ];
        GallerySetting::create($gallerySettingData);
    }
}
