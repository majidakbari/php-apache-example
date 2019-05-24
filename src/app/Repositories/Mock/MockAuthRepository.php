<?php

namespace App\Repositories\Mock;

use App\Entities\Role;
use App\Entities\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class MysqlUserRepository
 * @package App\Repositories\Mysql
 */
class MockAuthRepository implements AuthRepositoryInterface
{

    /**
     * @return User|Builder|\Illuminate\Database\Eloquent\Model|object|null
     * @param int|string $authorizationHeader
     */
    public function user($authorizationHeader = 0)
    {
        return User::query()->whereHas('roles', function (Builder $builder) use ($authorizationHeader) {
            $name = $authorizationHeader == 1 ? Role::ROLE_ADMIN : Role::ROLE_NORMAL;
            $builder->where('name', $name);
        })->first();
    }
}
