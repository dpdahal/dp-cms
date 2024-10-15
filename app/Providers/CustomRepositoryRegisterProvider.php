<?php

namespace App\Providers;

use App\Repositories\Account\AccountType\AccountTypeInterface;
use App\Repositories\Account\AccountType\AccountTypeRepository;
use App\Repositories\Account\Admin\AdminInterface;
use App\Repositories\Account\Admin\AdminRepository;
use App\Repositories\Address\ContinentInterface;
use App\Repositories\Address\ContinentRepository;
use App\Repositories\Address\CountryInterface;
use App\Repositories\Address\CountryRepository;
use App\Repositories\Album\AlbumInterface;
use App\Repositories\Album\AlbumRepository;
use App\Repositories\Gallery\GalleryInterface;
use App\Repositories\Gallery\GalleryRepository;
use App\Repositories\GallerySetting\GallerySettingInterface;
use App\Repositories\GallerySetting\GallerySettingRepository;
use App\Repositories\MemberType\MemberTypeInterface;
use App\Repositories\MemberType\MemberTypeRepository;
use App\Repositories\Permission\PermissionInterface;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Profile\UserProfileInterface;
use App\Repositories\Profile\UserProfileRepository;
use App\Repositories\Roles\RolesInterface;
use App\Repositories\Roles\RolesRepository;
use App\Repositories\Team\TeamInterface;
use App\Repositories\Team\TeamRepository;
use Illuminate\Support\ServiceProvider;

class CustomRepositoryRegisterProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RolesInterface::class, RolesRepository::class);
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(AccountTypeInterface::class, AccountTypeRepository::class);
        $this->app->bind(UserProfileInterface::class, UserProfileRepository::class);
        $this->app->bind(MemberTypeInterface::class, MemberTypeRepository::class);
        $this->app->bind(TeamInterface::class, TeamRepository::class);
        $this->app->bind(ContinentInterface::class, ContinentRepository::class);
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        $this->app->bind(AlbumInterface::class, AlbumRepository::class);
        $this->app->bind(GalleryInterface::class, GalleryRepository::class);
        $this->app->bind(GallerySettingInterface::class, GallerySettingRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
