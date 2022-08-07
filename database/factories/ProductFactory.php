<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'summary' => $this->faker->text,
            'description' => $this->faker->text,
            'stock' => $this->faker->numberBetween(2, 10),
            'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
            'vendor_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'cat_id' => $this->faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'child_cat_id' => $this->faker->randomElement(Category::where('is_parent',0)->pluck('id')->toArray()),
            'photo'=>'https://source.unsplash.com/random',
            'price'=>$this->faker->numberBetween(10,100),
            'offer_price'=>$this->faker->numberBetween(10,100),
            'discount'=>$this->faker->numberBetween(1,75),
            'release' => $this->faker->date('Y_m_d'),
            'multiplayer' => $this->faker->randomElement(['multiplayer', 'single']),
            'system' => $this->faker->sentences(3, true),
            'CPU' => $this->faker->sentences(3, true),
            'memory' => $this->faker->numberBetween(1, 10),
            'graph' => $this->faker->sentences(3, true),
            'size' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
