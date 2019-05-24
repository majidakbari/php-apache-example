<?php

namespace Tests\Feature;

use App\Entities\Asset;
use App\Entities\Role;
use App\Entities\User;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;


/**
 * Class FindNormalUserAssetsAPITest
 * This class will call the application by http request and compare the status code and the response body with
 * the desired ones
 *
 * @package Tests\Feature
 */
class FindNormalUserAssetsAPITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->withHeaders([
            'accept' => 'application/json', 'authorization' => 0
        ])->get(
            route('asset.index', [], false) . '?perPage=500&page=1'
        );

        $normalUser = User::query()->whereHas('roles', function(Builder $builder) {
            $builder->where('name', Role::ROLE_NORMAL);
        })->first();

        $userId = $normalUser ? $normalUser->id : null;

        $expectedAssets = Asset::query()->whereHas('groups', function (Builder $builder) use($userId) {
            $builder->whereHas('users', function (Builder $builder) use($userId) {
                $builder->where('id', $userId);
            });
        })->orderBy('id', 'desc')->get();


        $response->assertStatus(200)
            ->assertJsonCount($expectedAssets->count(), 'data');
    }
}
