<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @throws \Exception
     * @return array
     */
    public function definition(): array
    {
        return [
//            'role_id' => random_int(1, 4),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'password' => $this->faker->md5,
//            'status' => 0,
//            'api_token' => $this->faker->sha256,
//            'gl_token' => $this->faker->md5,
//            'fb_token' => fn () => null,
//            'verified_at' => $this->faker->dateTime(),
//            'created_at' => $this->faker->dateTime,
//            'updated_at' => $this->faker->dateTime,
        ];
    }
}
