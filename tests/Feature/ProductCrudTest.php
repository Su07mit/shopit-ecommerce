<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductCrudTest extends TestCase
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

    public function test_can_load_products_index_page()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        // $product = Product::factory()->create();

        $response = $this->get('/admin/products');
        $response->assertStatus(200);

        // $response->assertSeeText($product->id);
        // $response->assertSeeText($product->name);
        // $response->assertSeeText($product->slug);
    }

    public function test_only_admin_can_add_product()
    {
        $response = $this->post('/admin/products', [
            'name'          => 'name',
            'slug'          => 'name1',
            'price'         =>  '1200',
            'description'   => 'product',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseCount('products', 0);
    }

    public function test_can_delete_product()
    {
        $this->actingAs($this->user);
        $this->withoutExceptionHandling();

        Product::factory()->create();

        $response = $this->delete('/admin/products/1');

        $response->assertStatus(302);

        $this->assertDatabaseCount('products', 0);
    }

    // public function test_can_add_new_product()
    // {
    //     $this->withoutExceptionHandling();
    //     $this->actingAs($this->user);

    //     $product = Product::factory()->create();

    //     $response = $this->post('/admin/products', [
    //         'name'          => $product->name,
    //         'slug'          => $product->slug,
    //         'price'         => $product->price,
    //         'description'   => $product->description,
    //     ]);

    //     $response->assertStatus(302);

    //     $product = Product::first();

    //     $this->assertDatabaseCount('products', 1);
    //     $this->assertEquals('name', $product->name);
    //     $this->assertEquals('name1', $product->slug);
    //     $this->assertEquals('1200', $product->price);
    //     $this->assertEquals('product', $product->description);
    // }

    // public function test_can_update_product_details()
    // {
    //     $this->actingAs($this->user);
    //     $this->withoutExceptionHandling();

    //     $product = Product::factory()->create();

    //     $response = $this->post('/admin/products', [
    //         'name'          => $product->name,
    //         'slug'          => $product->slug,
    //         'price'         => $product->price,
    //         'description'   => $product->description,
    //     ]);

    //     $response = $this->patch('/admin/products/1', [
    //         'name'          => 'laptop',
    //         'slug'          => 'slug',
    //         'price'         =>  '1500',
    //         'description'   => 'electronics',
    //     ]);

    //     $product = Product::first();

    //     $this->assertEquals('laptop', $product->name);
    //     $this->assertEquals('slug', $product->slug);
    //     $this->assertEquals('1500', $product->price);
    //     $this->assertEquals('electronics', $product->description);

    //     $response->assertStatus(302);
    // }


}
