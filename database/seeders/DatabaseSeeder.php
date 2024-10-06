<?php

namespace Database\Seeders;

use App\Models\Enums\UserLevel;
use App\Models\Exoplanet;
use App\Models\Gamer;
use App\Models\Publication;
use App\Models\Star;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createAdmins();
//        DB::table('exoplanets')->truncate();
//        DB::table('stars')->truncate();
//        DB::table('publications')->truncate();
//        Star::factory(3)->create()->each(function (Star $star) {
//            Exoplanet::factory(100)->create([
//                'star_id' => $star->id,
//            ])->each(function (Exoplanet $exoplanet) {
//                Publication::factory(3)->create([
//                    'exoplanet_id' => $exoplanet->id,
//                ]);
//            });
//        });
////        DB::table('gamers')->truncate();
//        Gamer::factory(100)->create();
    }

    private function createAdmins(): void
    {
        $this->createAdmin();
        $this->createTeacher();
    }

    private function createAdmin(): void
    {
        if (User::where('email', 'yehor@exodoo.space')->exists()) {
            return;
        }

        User::factory()->create([
            'name' => 'Yehor Herasymchuk',
            'email' => 'yehor@exodoo.space',
            'password' => Hash::make('yehor@exodoo.space'),
            'level' => UserLevel::ADMIN,
        ]);
    }

    private function createTeacher(): void
    {
        if (User::where('email', 'demo@exodoo.space')->exists()) {
            return;
        }

        User::factory()->create([
            'name' => 'Demo Nasa',
            'email' => 'demo@exodoo.space',
            'password' => Hash::make('demo@exodoo.space'),
            'level' => UserLevel::TEACHER,
        ]);
    }
}
