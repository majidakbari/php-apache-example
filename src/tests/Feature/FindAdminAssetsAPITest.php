<?php

namespace Tests\Feature;

use App\Entities\Asset;
use Tests\TestCase;


/**
 * Class FindAdminAssetsAPITest
 * This class will call the application by http request and compare the status code and the response body with
 * the desired ones
 *
 * @package Tests\Feature
 */
class FindAdminAssetsAPITest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->withHeaders([
            'accept' => 'application/json', 'authorization' => 1
        ])->get(
            route('asset.index', [], false) . '?perPage=500&page=1'
        );

        $response->assertStatus(200)
            ->assertJsonCount(Asset::query()->count(), 'data');
    }
}
