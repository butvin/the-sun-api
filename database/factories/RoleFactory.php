<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(7),
            'code' => random_int(1, 999),
            'description' => $this->faker->text(),
            'status' => 1,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
