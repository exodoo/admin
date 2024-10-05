<?php
/**
 * Description of LikePlanetTinderApiControllerTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Tests\Feature\Http\Api\Games\Tinder\Gamers;


use App\Models\Exoplanet;
use App\Models\Gamer;
use Tests\Feature\Http\HttpTestCase;

class LikePlanetTinderApiControllerTest extends HttpTestCase
{

    public function testLikeWorks(): void
    {
        $exoplanet1 = Exoplanet::factory()->withStar()->create();
        $exoplanet2 = Exoplanet::factory()->withStar()->create();
        /** @var Gamer $gamer */
        $gamer = Gamer::factory()->create();

        $this->postJson(route('api.games.tinder.gamers.exoplanets.like', [
            'exoplanet' => $exoplanet1->id,
            'gamer' => $gamer->id
        ]))->assertOk();

        $updatedGamer = $gamer->fresh();

        $this->assertTrue($updatedGamer->hasExoplanet($exoplanet1));
        $this->assertFalse($updatedGamer->hasExoplanet($exoplanet2));

    }

}
