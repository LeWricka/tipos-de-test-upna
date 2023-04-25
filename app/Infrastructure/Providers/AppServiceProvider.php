<?php

namespace App\Infrastructure\Providers;

use App\DataSource\Database\EloquentUserDataSource;
use App\Domain\UserRepository;
use App\Infrastructure\Persistence\FileUserRepository;
use Illuminate\Support\ServiceProvider;
use Tests\app\Infrastructure\Controller\FakeUserDatasource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            $this->app->bind(UserRepository::class, function () {
                return new FileUserRepository();
            });
    }
}
