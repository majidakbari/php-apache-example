<?php

namespace App\Repositories\Interfaces;

use App\Entities\Group;

/**
 * Interface GroupRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface GroupRepositoryInterface
{
    /**
     * @param Group $group
     * @return Group
     */
    public function store(Group $group);
}
