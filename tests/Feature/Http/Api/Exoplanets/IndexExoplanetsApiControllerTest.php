<?php
/**
 * Description of IndexExoplanetsApiControllerTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Tests\Feature\Http\Api\Exoplanets;


use App\Models\Exoplanet;
use App\Models\Publication;
use App\Models\Star;
use Tests\Feature\Http\HttpTestCase;

class IndexExoplanetsApiControllerTest extends HttpTestCase
{

    public function testIndexReturnsEmpty(): void
    {
        $this->getJson('/api/exoplanets')
            ->assertOk()
            ->assertJson([]);
    }

    public function testIndex(): void
    {
        $star1 = Star::factory()->create();
        $star2 = Star::factory()->create();

        $exoplanet1 = Exoplanet::factory()->create([
            'name' => 'a',
            'star_id' => $star1->id,
        ]);
        $exoplanet2 = Exoplanet::factory()->create([
            'star_id' => $star1->id,
            'name' => 'c',
        ]);
        $exoplanet3 = Exoplanet::factory()->create([
            'star_id' => $star2->id,
            'name' => 'b',
        ]);

        $response = $this->getJson('/api/exoplanets')
            ->assertOk()
            ->assertJsonStructure([
                'items',
                'total',
            ]);

        $items = $response->json('items');
        $this->assertCount(3, $items);
        $this->assertEquals(3, $response->json('total'));
        $this->assertEquals($exoplanet1->id, $items[0]['id']);
        $this->assertEquals($exoplanet2->id, $items[2]['id']);
        $this->assertEquals($exoplanet3->id, $items[1]['id']);
    }

    public function testWithRelations(): void
    {
        $star1 = Star::factory()->create();

        $exoplanet1 = Exoplanet::factory()->create([
            'name' => 'a',
            'star_id' => $star1->id,
        ]);

        Publication::factory(2)->create([
            'exoplanet_id' => $exoplanet1->id,
        ]);

        $response = $this->getJson('/api/exoplanets')
            ->assertOk()
            ->assertJsonStructure([
                'items' => [
                    '*' => [
                        'star' => [
                            'id',
                            'name',
                        ],
                        'publications' => [
                            '*' => [
                                'id',
                                'title',
                                'description',
                            ],
                        ]
                    ],
                ],
                'total',
            ]);

        $items = $response->json('items');
        $this->assertCount(1, $items);
        $this->assertEquals(1, $response->json('total'));
        $this->assertEquals($exoplanet1->star->id, $items[0]['star']['id']);
        $this->assertEquals($exoplanet1->star->name, $items[0]['star']['name']);
    }

}
