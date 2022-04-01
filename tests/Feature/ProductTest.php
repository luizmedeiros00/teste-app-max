<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product()
    {
        $this->post('/products', [
            'name'  => 'Monitor',
            'sku'   => 'ab-ass-123'
        ])->assertSessionHas('success', 'Produto cadastrado com sucesso');

        $this->assertDatabaseHas('products', [
            'name'  => 'Monitor',
            'sku'   => 'ab-ass-123'
        ]);
    }

    public function test_validation_payloads_null()
    {
        $this->post('/products', [
            'name'  => null,
            'sku'   => null
        ])->assertSessionHasErrors([
            'name'  => 'O nome do produto é obrigatório',
            'sku'   => 'O sku do produto é obrigatório'
        ]);
    }

    public function test_validation_unique_sku()
    {
        Product::factory()->create(['sku' => 123]);

        $this->post('/products', [
            'name'  => 'name product',
            'sku'   => 123
        ])->assertSessionHasErrors([
            'sku'   => 'O sku do produto já existe'
        ]);

        $this->assertDatabaseMissing('products', [
            'name'  => 'name product',
            'sku'   => 123
        ]);
    }
}
