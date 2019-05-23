<?php

namespace App\Repositories\Interfaces;

use App\Entities\Asset;

/**
 * Interface AssetRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface AssetRepositoryInterface
{
    /**
     * @param Asset $asset
     * @return Asset
     */
    public function store(Asset $asset);


    /**
     * @param Asset $asset
     * @param array $groupIds
     * @return void
     */
    public function attachGroups(Asset $asset, array $groupIds);


    /**
     * @param $criteria
     * @param array $paginate
     * @param array $relations
     * @param array $columns
     * @param string $sort
     * @param string $sortDirection
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function findManyByCriteria(
        $criteria,
        $paginate = [],
        $relations = [],
        $columns = ['*'],
        $sort = 'id',
        $sortDirection = 'desc'
    );
}
