<?php

namespace App\Repositories\Mysql;

use App\Entities\Role;
use App\Repositories\Interfaces\RoleRepositoryInterface;

/**
 * Class MysqlUserRepository
 * @package App\Repositories\Mysql
 */
class MysqlRoleRepository implements RoleRepositoryInterface
{

    /**
     * @param Role $role
     * @return Role
     */
    public function store(Role $role): Role
    {
        $role->save();

        return $role;
    }
}
