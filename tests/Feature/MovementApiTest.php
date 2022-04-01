<?php

namespace Tests\Feature;

use App\Models\Movement;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MovementApiTest extends TestCase
{
    use RefreshDatabase;

    private function login()
    {
        $user = User::factory(['password' => Hash::make(123)])->create();

        $response = $this->postJson('/api/login', [
            'email'     => $user->email,
            'password'  => 123
        ]);

        return json_decode($response->getContent());
    }

    public function test_add_product_api()
    {
        $auth = $this->login();

        $product = Product::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth->access_token
        ])
            ->postJson('/api/adicionar-produto', [
                'product_id' => $product->id,
                'amount'    => 100
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('movements', [
            'product_id'            => $product->id,
            'amount'                => 100,
            'type_movement_id'      => 1,
            'origin_movement_id'    => 2
        ]);

        $this->assertDatabaseHas('inventories', [
            'product_id' => $product->id,
            'current_amount' => 100
        ]);
    }

    public function test_validation_payloads_null_add_product_api()
    {
        $auth = $this->login();

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth->access_token
        ])
            ->postJson('/api/adicionar-produto', [
                'product_id' => null,
                'amount'    => null
            ])->assertJsonValidationErrors([
                'product_id'    => 'O produto é obrigatório',
                'amount'        => 'A quantidade é obrigatória'
            ]);
    }

    public function test_validation_amount_min_add_product_api()
    {
        $auth = $this->login();

        $product = Product::factory()->create();

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth->access_token
        ])
            ->postJson('/api/adicionar-produto', [
                'product_id'    => $product->id,
                'amount'        => -100
            ])->assertJsonValidationErrors([
                'amount'    => 'A quantidade deve ser no mínimo 1',
            ]);
    }

    public function test_validation_product_id_not_exists_add_product_api()
    {
        $auth = $this->login();

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth->access_token
        ])
            ->postJson('/api/adicionar-produto', [
                'product_id' => 2,
                'amount'    => 100
            ])->assertJsonValidationErrors([
                'product_id'    => 'O produto não existe',
            ]);
    }

    public function test_remove_product_api()
    {
        $auth = $this->login();

        $movement = Movement::factory()
            ->for(Product::factory()->create())
            ->for(User::factory()->create())
            ->create([
                'amount' => 100,
            ]);

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth->access_token
        ])
            ->postJson('/api/baixar-produto', [
                'product_id'    => $movement->product_id,
                'amount'        => 20
            ])->assertStatus(200);

        $this->assertDatabaseHas('inventories', [
            'product_id' => $movement->product_id,
            'current_amount' => 80
        ]);
    }

    public function test_validation_remove_product_with_invalid_amount_api()
    {
        $auth = $this->login();

        $movement = Movement::factory()
            ->for(Product::factory()->create())
            ->for(User::factory()->create())
            ->create([
                'amount' => 100,
            ]);

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth->access_token
        ])
            ->postJson('/api/baixar-produto', [
                'product_id'    => $movement->product_id,
                'amount'        => 120
            ])->assertJsonValidationErrors([
                'amount'    => 'A quantidade do produto em estoque é insuficiente',
            ]);
    }
}
