<?php

namespace App\Repositories\Interfaces;

use App\Entities\User;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface AuthRepositoryInterface
{
    /**
     * @param int|string $authorizationHeader
     * @return User|null
     */
    public function user($authorizationHeader = 0);

}
