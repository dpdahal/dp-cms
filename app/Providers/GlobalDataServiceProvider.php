<?php

namespace App\Providers;

use App\Models\Address\Country;
use App\Models\Gallery\Album;
use App\Models\Page\Menu;
use App\Models\Setting\Setting;
use App\Models\User\AccountType;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class GlobalDataServiceProvider extends ServiceProvider
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
    public function boot(): void
    {


    }
}
