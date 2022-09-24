<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Helpers\NameGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
//            'name' => NameGenerator::generate(5)
        'name' => $this->faker->name()
        ];
    }
}
