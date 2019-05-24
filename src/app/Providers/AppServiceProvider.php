<?php

namespace App\Providers;

use App\Repositories\Interfaces\AssetRepositoryInterface;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Mysql\MysqlAssetRepository;
use App\Repositories\Mock\MockAuthRepository;
use App\Repositories\Mysql\MysqlGroupRepository;
use App\Repositories\Mysql\MysqlRoleRepository;
use App\Repositories\Mysql\MysqlUserRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Creating containers, this provider is not deferred ;)
 * Class AppServiceProvider
 * @package App\Providers
 */
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
    public function boot(): void
    {
        $this->bindImplementations();
    }


    /**
     * This function will bind interfaces to their implementations
     * @return void
     */
    private function bindImplementations(): void
    {
        $this->app->bind(UserRepositoryInterface::class, MysqlUserRepository::class);
        $this->app->bind(AssetRepositoryInterface::class, MysqlAssetRepository::class);
        $this->app->bind(GroupRepositoryInterface::class, MysqlGroupRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, MysqlRoleRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, MockAuthRepository::class);
    }
}
