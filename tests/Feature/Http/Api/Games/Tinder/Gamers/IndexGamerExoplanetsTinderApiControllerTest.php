<?php
/**
 * Description of IndexGamerExoplanetsTinderApiControllerTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Tests\Feature\Http\Api\Games\Tinder\Gamers;


use App\Models\Exoplanet;
use App\Models\Gamer;
use Tests\Feature\Http\HttpTestCase;

class IndexGamerExoplanetsTinderApiControllerTest extends HttpTestCase
{

    public function testReturnNotFoundForNonExistingUser(): void
    {
        $this->getJson(route('api.games.tinder.gamers.exoplanets.index', [
            'gamer' => 1,
        ]))
            ->assertNotFound();
    }

    public function testReturnEmpty(): void
    {
        $gamer = Gamer::factory()->create();

        $this->getJson(route('api.games.tinder.gamers.exoplanets.index', [
            'gamer' => $gamer->id,
        ]))
            ->assertOk()->assertJson([
                'items' => [],
                'total' => 0,
            ]);
    }

    public function testReturnLiked(): void
    {
        $gamer1 = Gamer::factory()->create();
        $gamer2 = Gamer::factory()->create();

        $exoplanet1 = Exoplanet::factory()->withStar()->create();
        $exoplanet2 = Exoplanet::factory()->withStar()->create();
        $exoplanet3 = Exoplanet::factory()->withStar()->create();
        $exoplanet4 = Exoplanet::factory()->withStar()->create();

        $gamer1->likeExoplanet($exoplanet1);
        $gamer1->likeExoplanet($exoplanet2);
        $gamer2->likeExoplanet($exoplanet2);
        $gamer2->likeExoplanet($exoplanet3);
        $gamer2->likeExoplanet($exoplanet4);

        $response = $this->getJson(route('api.games.tinder.gamers.exoplanets.index', [
            'gamer' => $gamer1->id,
        ]))
            ->assertOk()->assertJsonStructure([
                'items' => [
                    '*' => [
                        'id',
                        'name',
                        'star',
                    ],
                ],
                'total',
            ]);

        $items = $response->json('items');
        $this->assertCount(2, $items);
    }

}
