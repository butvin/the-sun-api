<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Number of generated users
     */
    const SEEDS_USERS_COUNT = 1024;

    /**
     * Run the 'users' table seeds
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()
            ->times(self::SEEDS_USERS_COUNT)
            ->create();
    }
}
