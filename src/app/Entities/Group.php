<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * @property int $id
 * @property string $name
 * @package App\Entities
 */
class Group extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];


    /**
     * The users that are joined with this group
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_groups_pivot');
    }


    /**
     * The assets that are managed by this group
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function assets()
    {
        return $this->belongsToMany(Asset::class, 'assets_groups_pivot');
    }
}
