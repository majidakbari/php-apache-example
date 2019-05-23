<?php

namespace App\Repositories\Mysql;

use App\Entities\Group;
use App\Repositories\Interfaces\GroupRepositoryInterface;

/**
 * Class MysqlUserRepository
 * @package App\Repositories\Mysql
 */
class MysqlGroupRepository implements GroupRepositoryInterface
{

    /**
     * @param Group $group
     * @return Group
     */
    public function store(Group $group): Group
    {
        $group->save();

        return $group;
    }
}
