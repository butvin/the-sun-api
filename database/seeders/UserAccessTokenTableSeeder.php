<?php


namespace Database\Seeders;

use App\Models\UserAccessToken;
use Illuminate\Database\Seeder;


class UserAccessTokenTableSeeder extends Seeder
{
    /**
     * Run the 'roles' table seeds
     *
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        UserAccessToken::factory()->times(12)->create();
    }
}
