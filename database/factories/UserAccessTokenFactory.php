<?php

namespace Database\Factories;

use App\Models\UserAccessToken;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAccessTokenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAccessToken::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'user_id' => random_int(1, 50),
            'token' => $this->faker->sha256,
            'remember_token' => $this->faker->md5,
            'status' => 1,
            'expires_at' => $this->faker->dateTime,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
