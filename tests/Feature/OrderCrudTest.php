<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderCrudTest extends TestCase
{
    use RefreshDatabase;
    public $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'Admin',
        ]);
    }

    public function test_can_load_order_index_page()
    {
        $this->actingAs($this->user);

        $order = Order::factory()->create();

        $response = $this->get('/admin/orders');

        $response->assertStatus(200);

        // $response->assertSeeText($order->shipping_name);
    }
}
