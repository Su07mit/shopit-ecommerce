<?php

namespace Tests\Feature;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CouponTest extends TestCase
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

    public function test_can_load_coupon_index_page()
    {
        $this->actingAs($this->user);
        $this->withoutExceptionHandling();

        $response = $this->get('/admin/coupons');

        $response->assertStatus(200);
    }

    public function test_can_add_coupon()
    {
        $this->actingAs($this->user);
        $this->withoutExceptionHandling();


        $response = $this->post('/admin/coupons', [
            'code' => '007',
            'description' => '',
        ]);

        $response->assertStatus(302);

        $coupon = Coupon::find(1);

        $this->assertDatabaseCount('coupons', 1);
        $this->assertEquals('007', $coupon->code);
    }
}
