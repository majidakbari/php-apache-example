<?php

namespace App\Repositories\Mysql;

use App\Entities\Asset;
use App\Repositories\Interfaces\AssetRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class MysqlUserRepository
 * @package App\Repositories\Mysql
 */
class MysqlAssetRepository implements AssetRepositoryInterface
{

    /**
     * @param Asset $asset
     * @return Asset
     */
    public function store(Asset $asset): Asset
    {
        $asset->save();

        return $asset;
    }


    /**
     * @param Asset $asset
     * @param array $groupIds
     * @return void
     */
    public function attachGroups(Asset $asset, array $groupIds): void
    {
        $asset->groups()->attach($groupIds);
    }

    /**
     * @param $criteria
     * @param array $paginate
     * @param array $relations
     * @param array $columns
     * @param string $sortColumn
     * @param string $sortDirection
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findManyByCriteria(
        $criteria,
        $paginate = [],
        $relations = [],
        $columns = ['*'],
        $sortColumn = 'id',
        $sortDirection = 'desc'
    )
    {
        $q = Asset::query()->select($columns)->with($relations)->orderBy($sortColumn, $sortDirection);

        if (isset($criteria['is_admin']) && !empty($criteria['user_id'])) {
            if (!$criteria['is_admin']) {

                $userId = $criteria['user_id'];

                $q->whereHas('groups.users', function (Builder $q) use ($userId) {
                    $q->where('user_id', $userId);
                });
            }
        }

        return !empty($paginate) ? $q->paginate($paginate['perPage'], $columns, 'page', $paginate['page']) : $q->get();
    }
}
