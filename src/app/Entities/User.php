<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;


/**
 * Class User
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property Collection $roles
 * @package App
 */
class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name',
    ];


    /**
     * The roles that this user has
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users_pivot');
    }


    /**
     * The groups that this user belongs to them
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'users_groups_pivot');
    }
}
