<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * Role entity
 *
 * @property int $id
 * @property string $name
 * @package App\Entities
 */
class Role extends Model
{

    const ROLE_ADMIN = 'admin';

    const ROLE_NORMAL = 'normal';

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];


    /**
     * The users that have this role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'roles_users_pivot');
    }
}
