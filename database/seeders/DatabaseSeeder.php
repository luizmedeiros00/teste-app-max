<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'email' => 'teste@email.com',
            'password' => Hash::make('teste123')
        ]);
        \App\Models\Product::factory(10)->create();
        $this->call(OriginMovementSeeder::class);
        $this->call(TypeMovementSeeder::class);
    }
}
