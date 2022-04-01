<?php

namespace Tests\Feature;

use App\Models\Movement;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovementWebTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_product()
    {
        $product = Product::factory()->create();

        $this->post('/adicionar-produto', [
            'product_id' => $product->id,
            'amount'    => 100
        ])->assertSessionHas('success', 'Produto adicionado com sucesso');

        $this->assertDatabaseHas('movements', [
            'product_id'            => $product->id,
            'amount'                => 100,
            'type_movement_id'      => 1,
            'origin_movement_id'    => 1
        ]);

        $this->assertDatabaseHas('inventories', [
            'product_id' => $product->id,
            'current_amount' => 100
        ]);
    }

    public function test_validation_payloads_null_add_product()
    {
        $this->post('/adicionar-produto', [
            'product_id' => null,
            'amount'    => null
        ])->assertSessionHasErrors([
            'product_id'    => 'O produto é obrigatório',
            'amount'        => 'A quantidade é obrigatória'
        ]);
    }

    public function test_validation_amount_min_add_product()
    {
        $product = Product::factory()->create();

        $this->post('/adicionar-produto', [
            'product_id'    => $product->id,
            'amount'        => -100
        ])->assertSessionHasErrors([
            'amount'    => 'A quantidade deve ser no mínimo 1',
        ]);
    }

    public function test_validation_product_id_not_exists_add_product()
    {
        $this->post('/adicionar-produto', [
            'product_id' => 2,
            'amount'    => 100
        ])->assertSessionHasErrors([
            'product_id'    => 'O produto não existe',
        ]);
    }

    public function test_remove_product()
    {
        $movement = Movement::factory()
            ->for(Product::factory()->create())
            ->for(User::factory()->create())
            ->create([
                'amount'=> 100,
            ]);

        $this->post('/baixar-produto', [
            'product_id'    => $movement->product_id,
            'amount'        => 20
        ])->assertSessionHas('success', 'Produto baixado com sucesso');

        $this->assertDatabaseHas('inventories', [
            'product_id' => $movement->product_id,
            'current_amount' => 80
        ]);
    }

    public function test_validation_remove_product_with_invalid_amount()
    {
        $movement = Movement::factory()
            ->for(Product::factory()->create())
            ->for(User::factory()->create())
            ->create([
                'amount'=> 100,
            ]);

        $this->post('/baixar-produto', [
            'product_id'    => $movement->product_id,
            'amount'        => 120
        ])->assertSessionHasErrors([
            'amount'    => 'A quantidade do produto em estoque é insuficiente',
        ]);
    }
}
