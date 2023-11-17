<?php

namespace Database\Factories;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'username' => $this->faker->unique()->userName(),
            'status' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'email' => $this->faker->unique()->safeEmail(),
            'birthday' => $this->faker->date,
            'gender' => Gender::cases()[$this->faker->numberBetween(0, 2)],
            'pronouns' => '[]',
            'bio' => $this->faker->paragraph(),
            'socials' => null,
            'email_verified_at' => now(),
            'password' => 'testing',
            'last_seen_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'is_online' => $this->faker->boolean(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
