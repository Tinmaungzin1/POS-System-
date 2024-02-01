<?php

namespace App\Providers;

use App\Repository\Item\ItemRepository;
use App\Repository\Item\ItemRepositoryInterface;
use App\Repository\Category\CategoryRepository;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Repository\Shift\ShiftRepository;
use App\Repository\Shift\ShiftRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ItemRepositoryInterface::class,ItemRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(ShiftRepositoryInterface::class,ShiftRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}