<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'name' => str($name)->title()->toString(),
            'code' => str($name)->slug('.')->toString(),
            'group' => fake()->randomElement(['dashboard', 'users', 'settings']),
            'description' => fake()->sentence(),
        ];
    }
}
