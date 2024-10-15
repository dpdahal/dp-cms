<?php

namespace App\Providers;

use App\Models\Gallery\Album;
use App\Models\Gallery\Gallery;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

    function removeDuplicateMonths($dates)
    {
        $result = [];
        $monthsByYear = [];

        foreach ($dates as $date) {
            $dateParts = explode('-', $date);
            $year = $dateParts[2];
            $month = $dateParts[1];

            if (!isset($monthsByYear[$year])) {
                $monthsByYear[$year] = [];
            }

            if (!in_array($month, $monthsByYear[$year])) {
                $monthsByYear[$year][] = $month;
                $result[] = $date;
            }
        }

        return $result;
    }

    public function boot(): void
    {
        $allAlbumData = Album::all();
        view()->share('allAlbumData', $allAlbumData);

        $gallery = Gallery::all();
        $dates = [];
        foreach ($gallery as $item) {
            $dates[] = $item->post_date;
        }

        $dates = array_unique($dates);
        $dates =$this->removeDuplicateMonths($dates);
        $formattedDates = array_map(function ($date) {
            return Carbon::createFromFormat('Y-m-d', $date)->format('F Y');
        }, $dates);
//        return array_combine($dates, $formattedDates);
        view()->share('galleryDate', array_combine($dates, $formattedDates));
    }
}
