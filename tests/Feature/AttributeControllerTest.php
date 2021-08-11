<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Attribute;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttributeControllerTest extends TestCase
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

    public function test_can_load_attribute_index_page()
    {
        $this->actingAs($this->user);

        $attribute = Attribute::factory()->create();

        $response = $this->get('/admin/attributes');
        $response->assertStatus(200);

        $response->assertSeeText($attribute->name);
    }

    public function test_can_add_attribute()
    {
        $this->actingAs($this->user);

        $response = $this->post('/admin/attributes', [
            'name' => 'weight',
        ]);

        $attribute = Attribute::first();
        $response->assertStatus(302);

        $this->assertDatabaseCount('attributes', 1);
        $this->assertEquals('weight', $attribute->name);
    }

    public function test_can_delete_attribute()
    {
        $this->actingAs($this->user);

        $attribute = Attribute::factory()->create();

        $response = $this->delete('/admin/attributes/1');

        $response->assertStatus(302);

        $this->assertDatabaseCount('attributes', 0);
    }
}
