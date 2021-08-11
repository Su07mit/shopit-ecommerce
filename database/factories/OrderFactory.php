<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shipping_name'         => $this->faker->name(),
            'shipping_address'      => $this->faker->address(),
            'shipping_city'         => $this->faker->city(),
            'shipping_street'       => $this->faker->streetAddress(),
            'shipping_phone'        => $this->faker->phoneNumber(),
            'billing_name'          => $this->faker->name(),
            'billing_address'       => $this->faker->address(),
            'billing_city'          => $this->faker->city(),
            'billing_street'        => $this->faker->streetAddress(),
            'billing_phone'         => $this->faker->phoneNumber(),
            'payment_method'        => $this->faker->word(),
            'subtotal'             => $this->faker->numberBetween($min = 1000, $max = 1500),
            'discount'              => $this->faker->numberBetween($min = 100, $max = 150),
            'total'                 => $this->faker->numberBetween($min = 900, $max = 1350),
            'status'                => $this->faker->word(),

        ];
    }
}
