<?php

namespace App\Repositories\Interfaces;

use App\Entities\Role;

/**
 * Interface RoleRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface RoleRepositoryInterface
{
    /**
     * @param Role $role
     * @return Role
     */
    public function store(Role $role);
}
