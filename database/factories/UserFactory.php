<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use RTippin\Messenger\Models\Messenger;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'demo' => true,
            'admin' => false,
            'password' => 'password',
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (User $user) {
            Messenger::factory()->owner($user)->create();
        });
    }
}
