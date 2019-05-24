<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * Asset Entity which extends eloquent
 *
 * @property int $id
 * @property string $name
 * @package App\Entities
 */
class Asset extends Model
{

    /**
     * The groups that this asset is managed by them
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'assets_groups_pivot');
    }
}
