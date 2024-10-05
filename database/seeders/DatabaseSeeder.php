<?php

namespace Database\Seeders;

use App\Models\Enums\UserLevel;
use App\Models\Planet;
use App\Models\Star;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createAdmin();
        DB::table('planets')->truncate();
        DB::table('stars')->truncate();
        Planet::factory(1000)->create();
        Star::factory(10)->create();
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
}
