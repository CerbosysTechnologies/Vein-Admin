<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; 


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Package::class;

    public function definition(): array
    {

        return [
            'name' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->randomLetter('200'),
            'price' => $this->faker->randomFloat(2, 0, 1000), 
            'total_test_included' => $this->faker->randomNumber(2)
        ];
    }
}
