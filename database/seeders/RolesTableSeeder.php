<?php


namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the 'roles' table seeds
     *
     * @return void
     */
    public function run(): void
    {
        $roles = ['guest', 'user', 'admin', 'godlike'];

        foreach ($roles as $role) {
            Role::insert([
                'name' => $role,
                'description' => Str::random(256),
                'status' => 1,
            ]);
        }

        //Role::factory()->times(12)->create();
    }
}
