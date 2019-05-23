<?php

namespace App\Repositories\Mysql;

use App\Entities\Role;
use App\Entities\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

/**
 * Class MysqlUserRepository
 * @package App\Repositories\Mysql
 */
class MysqlUserRepository implements UserRepositoryInterface
{

    /**
     * @param User $user
     * @return User
     */
    public function store(User $user): User
    {
        $user->save();

        return $user;
    }

    /**
     * @param User $user
     * @param Role $role
     * @return void
     */
    public function attachRole(User $user, Role $role): void
    {
        $user->roles()->attach($role->id);
    }

    /**
     * @param User $user
     * @param array $groupIds
     * @return void
     */
    public function attachGroups(User $user, array $groupIds): void
    {
        $user->groups()->attach($groupIds);
    }
}
