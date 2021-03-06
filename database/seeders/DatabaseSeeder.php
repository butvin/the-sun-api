<?php

namespace Database\Seeders;

use App\Models\UserAccessToken;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
         $this->call([
             /* necessary important core seeds*/
             RolesTableSeeder::class,
             /* additional seeds*/
             UsersTableSeeder::class,
             UserAccessTokenTableSeeder::class,
         ]);
    }
}
