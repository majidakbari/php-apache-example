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
     * @return User|null
     */
    public function user();

}
