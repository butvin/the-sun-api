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
            'role_id' => random_int(1, 4),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'password' => Hash::make($this->faker->password()),
            'status' => random_int(0, 1),
            'api_token' => Hash::make(Str::random(7)),
            'gl_token' => null,
            'fb_token' => fn () => null,
            'verified_at' => $this->faker->dateTime,
        ];
    }
}
