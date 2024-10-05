<?php
/**
 * Description of LikePlanetTinderApiControllerTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Tests\Feature\Http\Api\Games\Tinder\Exoplanets;


use App\Models\Exoplanet;
use Tests\Feature\Http\HttpTestCase;

class LikePlanetTinderApiControllerTest extends HttpTestCase
{

    public function testLikeWorks(): void
    {
        $planet = Exoplanet::factory()->withStar()->create();


    }

}
