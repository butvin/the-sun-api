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
            'user_id' => $this->faker->unique()->numberBetween(),
            'token' => $this->faker->sha256,
            'status' => 1,
            'expires_at' => $this->faker->dateTimeInInterval('now', '+1days')
//            'created_at' => $this->faker->dateTime,
//            'updated_at' => $this->faker->dateTime,
        ];
    }
}
