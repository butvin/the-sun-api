<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the 'users' table seeds
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()
            ->times(7)
            ->create();
    }
}
