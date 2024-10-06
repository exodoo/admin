<?php
/**
 * Description of ListMatchesGamerTinderApiControllerTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Tests\Feature\Http\Api\Games\Tinder\Gamers;


use App\Models\Exoplanet;
use App\Models\Gamer;
use App\Models\Star;
use Tests\Feature\Http\HttpTestCase;

class ListMatchesGamerTinderApiControllerTest extends HttpTestCase
{

    public function testListMatchesForEmpty(): void
    {
        $gamer = Gamer::factory()->create();
        $this->getJson(
            route('api.games.tinder.gamers.matches', [
                'gamer' => $gamer->id,
            ])
        )->assertOk()
            ->assertJson([
                'matches' => [],
            ]);
    }

    public function testAssertMatchesWithOnePlanet(): void
    {
        $gamer1 = Gamer::factory()->create();
        $gamer2 = Gamer::factory()->create();
        $gamer3 = Gamer::factory()->create();

        $star = Star::factory()->create();
        $exoplanet1 = Exoplanet::factory()->withStar($star)->create();
        $exoplanet2 = Exoplanet::factory()->withStar($star)->create();

        $gamer1->likeExoplanet($exoplanet1);
        $gamer2->likeExoplanet($exoplanet1);
        $gamer2->likeExoplanet($exoplanet2);
        $gamer3->likeExoplanet($exoplanet2);

        $response = $this->getJson(
            route('api.games.tinder.gamers.matches', [
                'gamer' => $gamer1->id,
            ])
        )->assertOk()
            ->assertJsonStructure([
                'matches' => [
                    '*' => [
                        'gamer_id',
                        'gamer' => [
                            'id',
                            'name',
                            'username',
                            'email',
                            'created_at',
                            'updated_at',
                        ],
                        'shared_exoplanets',
                    ],
                ],
            ]);

        $matches = $response->json('matches');
        $this->assertCount(1, $matches);
        $this->assertEquals($gamer2->id, $matches[0]['gamer_id']);
        $this->assertEquals(1, $matches[0]['shared_exoplanets']);
    }

    public function testAssertMatchesComplex(): void
    {
        $gamer1 = Gamer::factory()->create();
        $gamer2 = Gamer::factory()->create();
        $gamer3 = Gamer::factory()->create();
        $gamer4 = Gamer::factory()->create();
        $gamer5 = Gamer::factory()->create();
        $gamer6 = Gamer::factory()->create();
        $gamer7 = Gamer::factory()->create();

        $star = Star::factory()->create();
        $exoplanet1 = Exoplanet::factory()->withStar($star)->create();
        $exoplanet2 = Exoplanet::factory()->withStar($star)->create();
        $exoplanet3 = Exoplanet::factory()->withStar($star)->create();
        $exoplanet4 = Exoplanet::factory()->withStar($star)->create();
        $exoplanet5 = Exoplanet::factory()->withStar($star)->create();
        $exoplanet6 = Exoplanet::factory()->withStar($star)->create();
        $exoplanet7 = Exoplanet::factory()->withStar($star)->create();
        $exoplanet8 = Exoplanet::factory()->withStar($star)->create();
        $exoplanet9 = Exoplanet::factory()->withStar($star)->create();
        $exoplanet10 = Exoplanet::factory()->withStar($star)->create();

        $gamer1->likeExoplanet($exoplanet1);
        $gamer1->likeExoplanet($exoplanet2);
        $gamer1->likeExoplanet($exoplanet3);
        $gamer1->likeExoplanet($exoplanet7);
        $gamer1->likeExoplanet($exoplanet8);
        $gamer1->likeExoplanet($exoplanet10);

        $gamer2->likeExoplanet($exoplanet1);
        $gamer2->likeExoplanet($exoplanet2);
        $gamer2->likeExoplanet($exoplanet3);
        $gamer2->likeExoplanet($exoplanet8);
        $gamer2->likeExoplanet($exoplanet9);
        $gamer2->likeExoplanet($exoplanet10);

        $gamer3->likeExoplanet($exoplanet1);
        $gamer3->likeExoplanet($exoplanet4);
        $gamer3->likeExoplanet($exoplanet5);
        $gamer3->likeExoplanet($exoplanet6);

        $gamer4->likeExoplanet($exoplanet2);
        $gamer4->likeExoplanet($exoplanet3);
        $gamer4->likeExoplanet($exoplanet4);
        $gamer4->likeExoplanet($exoplanet6);

        $gamer5->likeExoplanet($exoplanet2);
        $gamer5->likeExoplanet($exoplanet3);
        $gamer5->likeExoplanet($exoplanet4);
        $gamer5->likeExoplanet($exoplanet6);
        $gamer5->likeExoplanet($exoplanet7);

        $gamer6->likeExoplanet($exoplanet6);

        $response = $this->getJson(
            route('api.games.tinder.gamers.matches', [
                'gamer' => $gamer1->id,
            ])
        )->assertOk();

        $matches = $response->json('matches');
        $this->assertCount(4, $matches);
        $this->assertEquals($gamer2->id, $matches[0]['gamer_id']);
        $this->assertEquals($gamer2->name, $matches[0]['gamer']['name']);
        $this->assertEquals($gamer2->username, $matches[0]['gamer']['username']);
        $this->assertEquals($gamer2->email, $matches[0]['gamer']['email']);
        $this->assertEquals(5, $matches[0]['shared_exoplanets']);

        $this->assertEquals($gamer5->id, $matches[1]['gamer_id']);
        $this->assertEquals(3, $matches[1]['shared_exoplanets']);

        $this->assertEquals($gamer4->id, $matches[2]['gamer_id']);
        $this->assertEquals(2, $matches[2]['shared_exoplanets']);

        $this->assertEquals($gamer3->id, $matches[3]['gamer_id']);
        $this->assertEquals(1, $matches[3]['shared_exoplanets']);
    }

}
