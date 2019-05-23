<?php

namespace Tests\Unit;

use App\Entities\Asset;
use App\Repositories\Interfaces\AssetRepositoryInterface;
use Tests\TestCase;

/**
 * Class FindAdminAssetsTest
 * @package Tests\Unit
 */
class FindAdminAssetsTest extends TestCase
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
        /** @var AssetRepositoryInterface $assetRepository */
        $assetRepository = resolve(AssetRepositoryInterface::class);

        $assets = $assetRepository->findManyByCriteria(['is_admin' => true]);

        $this->assertCount(
            Asset::query()->count(), $assets
        );
    }
}
