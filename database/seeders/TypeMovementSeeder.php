<?php

namespace Database\Seeders;

use App\Models\TypeMovement;
use Illuminate\Database\Seeder;

class TypeMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Entrada',
            'Saída'
        ];

        foreach($datas as $data){
            TypeMovement::firstOrCreate([
                'name' => $data
            ]);
        }
    }
}
