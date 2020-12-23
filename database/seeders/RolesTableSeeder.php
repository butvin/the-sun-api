<?php


namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    protected array $roles = ['guest', 'user', 'admin', 'godlike'];
    /**
     * Run the 'roles' table seeds
     *
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        foreach ($this->roles as $role) {
            Role::insert([
                'name' => $role,
                'code' => random_int(100, 999),
                'description' => Str::random(256),
                'status' => 1,
//                'created_at' => time(),
            ]);
        }

        //Role::factory()->times(12)->create();
    }
}
