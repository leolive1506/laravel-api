<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_check_if_product_store_method_is_working()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Produto de teste',
            'price' => 10.50,
            'description' => 'Descrição do produto teste',
            'slug' => 'produto-test',
        ]);

        $product = Product::findOrFail($response['id']);
        $this->assertDatabaseHas('products', ['id' => $product->id]);
        $this->assertModelExists($product);

        $response->assertStatus(200);
    }

    public function test_check_if_product_update_method_is_working()
    {
        $product = Product::factory()->create();

        $response = $this->put('/api/products/' . $product->id, [
            'name' => 'Produto de teste updated',
            'price' => 150.50,
            'description' => 'Descrição do produto teste updated',
            'slug' => 'produto-test-updated',
        ]);

        $this->assertDatabaseHas('products', ['name' => 'Produto de teste updated']);
        $response->assertStatus(200);
    }

    public function test_check_if_product_destoy_method_is_working()
    {
        $product = Product::factory()->create();
        $response = $this->delete('/api/products/' . $product->id);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $this->assertModelMissing($product);

        $response->assertStatus(200);
    }

    public function test_check_if_product_show_method_is_working()
    {
        $product = Product::factory()->create();
        $response = $this->getJson('/api/products/' . $product->id);

        $response
            ->assertStatus(200)
            ->assertJsonPath('data.id', $product->id);
    }
}
