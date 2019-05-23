<?php

namespace Tests\Unit;

use App\Entities\Asset;
use App\Entities\Role;
use App\Entities\User;
use App\Repositories\Interfaces\AssetRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;


/**
 * Class FindNormalUserAssetsTest
 * @package Tests\Unit
 */
class FindNormalUserAssetsTest extends TestCase
{
    /*
   |--------------------------------------------------------------------------
   | (Note) Repository testing
   |--------------------------------------------------------------------------
   | Unit testing repositories in a project is not recommended.
   | When you're dealing with a repository, you're really dealing
   | with something that's meant to be tested against a real database connection.
   |
   | But here is a sample of repository testing
   */


    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $normalUser = User::query()->whereHas('roles', function(Builder $builder) {
            $builder->where('name', Role::ROLE_NORMAL);
        })->first();

        $userId = $normalUser ? $normalUser->id : null;

        $expectedAssets = Asset::query()->whereHas('groups', function (Builder $builder) use($userId) {
            $builder->whereHas('users', function (Builder $builder) use($userId) {
                $builder->where('id', $userId);
            });
        })->orderBy('id', 'desc')->get();

        /** @var AssetRepositoryInterface $assetRepository */
        $assetRepository = resolve(AssetRepositoryInterface::class);

        $assets = $assetRepository->findManyByCriteria(['is_admin' => false, 'user_id' => $userId]);

        $this->assertEquals($expectedAssets->toArray(), $assets->toArray());
    }
}
