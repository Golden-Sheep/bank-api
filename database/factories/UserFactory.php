<?php

namespace Database\Factories;

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
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cpf_cnpj' => fake()->numerify('###########'),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'is_seller' => 0,
            'balance' => 50,
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

    /**
     * Configure the model to have a CNPJ instead of a CPF.
     */
    public function withCNPJ(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'cpf_cnpj' => fake()->numerify('##############'),
            ];
        });
    }

    /**
     * Configure the model to be a seller.
     */
    public function asSeller(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_seller' => 1,
        ]);
    }
}
