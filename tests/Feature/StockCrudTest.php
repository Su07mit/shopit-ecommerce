<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockCrudTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('password'),
            'role'      => 'Admin',
        ]);
    }

    public function test_can_load_stocks_index_page()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        $response = $this->get('/admin/stocks');

        $response->assertStatus(200);
    }
}
