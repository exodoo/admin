<?php
/**
 * Description of StoreGamerTinderApiControllerTest.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Tests\Feature\Http\Api\Games\Tinder\Gamers;


use App\Models\Gamer;
use Illuminate\Support\Str;
use Tests\Feature\Http\HttpTestCase;

class StoreGamerTinderApiControllerTest extends HttpTestCase
{

    public function testUnprocessableWithEmptyData(): void
    {
        $this->postJson('/api/games/tinder/gamers', [

        ],
        )->assertUnprocessable();
    }

    public function testUnprocessableWithUsedEmail(): void
    {
        /** @var Gamer $gamer */
        $gamer = Gamer::factory()->create();
        /** @var Gamer $model */
        $model = Gamer::factory()->make([
            'email' => $gamer->email,
        ]);
        $this->postJson('/api/games/tinder/gamers', [
            'username' => $model->username,
            'email' => $model->email,
            'name' => $model->name,
        ],
        )->assertUnprocessable();
    }

    public function testUnprocessableWithUsedUsername(): void
    {
        /** @var Gamer $gamer */
        $gamer = Gamer::factory()->create();
        /** @var Gamer $model */
        $model = Gamer::factory()->make([
            'username' => $gamer->username,
        ]);
        $this->postJson('/api/games/tinder/gamers', [
            'username' => $model->username,
            'email' => $model->email,
            'name' => $model->name,
        ],
        )->assertUnprocessable();
    }

    public function testCreate(): void
    {
        /** @var Gamer $model */
        $model = Gamer::factory()->make();
        $response = $this->postJson('/api/games/tinder/gamers', [
            'username' => $model->username,
            'email' => $model->email,
            'name' => $model->name,
        ],
        )->assertOk();

        $gamer = Gamer::find($response->json('id'));
        $this->assertNotNull($gamer);
        $this->assertSame($model->username, $gamer->username);
        $this->assertSame($model->email, $gamer->email);
        $this->assertSame($model->name, $gamer->name);
    }

    public function testCreateWOEmail(): void
    {
        $data = [
            'username' => Str::random(),
            'name' => Str::random(),
        ];
        $response = $this->postJson('/api/games/tinder/gamers', $data)->assertOk();

        $gamer = Gamer::find($response->json('id'));
        $this->assertNotNull($gamer);
        $this->assertSame($data['username'], $gamer->username);
        $this->assertSame($data['name'], $gamer->name);
        $this->assertNull($gamer->email);
    }

}
