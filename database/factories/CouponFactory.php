<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amount = $this->faker->numberBetween($min = 100, $max = 1000);
        return [
            'code'          => $this->faker->phoneNumber(),
            'amount'        => $amount,
            'is_amount'     => $this->faker->boolean(),
            'description'   => $this->faker->words(mt_rand(10, 20), true),
        ];
    }
}
