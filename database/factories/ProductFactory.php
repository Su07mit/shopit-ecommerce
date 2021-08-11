<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(mt_rand(1, 3), true);
        return [
            'name'          => $name,
            'slug'          => Str::slug($name) . Str::random(2),
            'price'         => $this->faker->numberBetween($min = 100, $max = 10000),
            'on_sale'       => $this->faker->boolean(),
            'sale_price'    => $this->faker->numberBetween($min = 90, $max = 9000),
            'description'   => $this->faker->text(),
            // 'media_id'      => $this->faker->unique()->randomDigit(),
            // 'category_id'   => $this->faker->unique()->randomDigit(),
        ];
    }
}
