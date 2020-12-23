<?php


namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;


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
            Role::factory(['name' => $role])->create();
        }
    }
}
