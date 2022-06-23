<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'notification_type' => $this->faker->randomElement(['email', 'sms', 'push', 'none']),
            'notification_objects' => $this->faker->randomElements(['page', 'post', 'both'], 2),
        ];
    }

    public function isAdmin(): static
    {
        return $this->state(function () {
            return [
                'is_admin' => 1,
            ];
        });
    }

    public function withNotificationObjects(): static
    {
        return $this->state(function () {
            return [
                'notification_objects' => json_encode($this->faker->randomElements(['page', 'post', 'both'], 2)),
            ];
        });
    }
}
