<?php

namespace Database\Seeders;

use App\Models\UserAccessToken;
use Illuminate\Database\Seeder;

class UserAccessTokenTableSeeder extends Seeder
{
    /**
     * Number of generated users
     */
    const SEEDS_TOKENS_COUNT = 512;

    /**
     * Run the 'roles' table seeds
     *
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        UserAccessToken::factory()
            ->times(self::SEEDS_TOKENS_COUNT)
            ->create();
    }
}
