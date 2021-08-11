<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryCrudTest extends TestCase
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

    public function test_can_load_category_index_page()
    {
        $this->actingAs($this->user);

        $category = Category::factory()->create();

        $response = $this->get('/admin/categories');
        $response->assertStatus(200);

        $response->assertSeeText($category->id);
        $response->assertSeeText($category->name);
    }

    public function test_can_add_new_category()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $response = $this->post('/admin/categories', [
            'name' => 'newcat',
            'slug' => 'appslug',
        ]);

        $response->assertStatus(302);

        $category = Category::first();

        $this->assertDatabaseCount('categories', 1);
        $this->assertEquals('newcat', $category->name);
        $this->assertEquals('appslug', $category->slug);
    }

    public function test_only_admin_can_add_categories()
    {
        $response = $this->post('/admin/categories', [
            'name' => 'name',
            'slug' => 'slug',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseCount('categories', 0);
    }

    public function test_can_update_category_details()
    {
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        // Category::factory()->create();

        $response = $this->post('/admin/categories', [
            'name' => 'name',
            'slug' => 'slug',
            'description' => 'leo',
        ]);

        $response = $this->patch('/admin/categories/1', [
            'name' => 'Name',
            'slug' => 'rog',
            'description' => 'legion',
        ]);

        $category = Category::first();

        $this->assertEquals('Name', $category->name);
        $this->assertEquals('rog', $category->slug);
        $this->assertEquals('legion', $category->description);
    }

    public function test_can_delete_category()
    {

        $this->actingAs($this->user);

        Category::factory()->create();

        $response = $this->delete('/admin/categories/1');

        $response->assertStatus(302);
        $this->assertDatabaseCount('categories', 0);
    }
}
