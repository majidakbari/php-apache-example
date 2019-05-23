<?php

namespace App\Repositories\Mysql;

use App\Entities\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;

/**
 * Class MysqlUserRepository
 * @package App\Repositories\Mysql
 */
class MysqlAuthRepository implements AuthRepositoryInterface
{

    /**
     * @return User|null
     */
    public function user()
    {
        $users = User::query()->with('roles')->limit(10)->get();

        return $users->random();
    }
}
