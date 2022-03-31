<?php

namespace Database\Seeders;

use App\Models\OriginMovement;
use Illuminate\Database\Seeder;

class OriginMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Web',
            'Api'
        ];

        foreach($datas as $data){
            OriginMovement::firstOrCreate([
                'name' => $data
            ]);
        }
    }
}
