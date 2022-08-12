<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'title'=>'Reforzar PHP',
                'descripcion'=>'Refozar php con el fin de poder trabajar con laravel',
                'status'=>false,
                'active'=>true
            ],
            [
                'title'=>'Aprender Laravel',
                'descripcion'=>'Refozar php con el fin de poder realizar una api',
                'status'=>false,
                'active'=>true
            ],
            [
                'title'=>'Aprender Ingles',
                'descripcion'=>'Para hablar ingles',
                'status'=>false,
                'active'=>true
            ]
            ]);
    }
}
