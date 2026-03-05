<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Office;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();

        return [
            'employee_id' => 'EMP-' . fake()->unique()->numerify('####'),
            'first_name' => $firstName,
            'middle_name' => fake()->optional()->firstName(),
            'last_name' => $lastName,
            'username' => Str::lower($firstName . '.' . $lastName . fake()->numberBetween(1, 999)),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'office_id' => Office::query()->inRandomOrder()->value('id')
                ?? Office::query()->firstOrCreate(
                    ['office_code' => 'GEN'],
                    ['name' => 'General Office', 'description' => 'Default office from factory']
                )->id,
            'role_id' => Role::query()->inRandomOrder()->value('id')
                ?? Role::query()->firstOrCreate(
                    ['name' => 'User'],
                    ['description' => 'Default role from factory']
                )->id,
            'remember_token' => Str::random(10),
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
