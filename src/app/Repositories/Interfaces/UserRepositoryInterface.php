<?php

namespace App\Repositories\Interfaces;

use App\Entities\Role;
use App\Entities\User;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return User
     */
    public function store(User $user);


    /**
     * @param User $user
     * @param Role $role
     * @return void
     */
    public function attachRole(User $user, Role $role);

    /**
     * @param User $user
     * @param array $groupIds
     * @return void
     */
    public function attachGroups(User $user, array $groupIds);
}
