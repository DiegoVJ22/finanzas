<?php

namespace Database\Seeders;

use App\Models\Patrimonio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatrimonioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // User 1
            [
                'user_id' => 1,
                'año' => 2024,
                'capital_social' => 28000,
                'beneficios' => 5000,
                'excedentes' => 23000,
                'reservas' => 6000,
                'utilidad_ejercicios_ant' => 19000,
            ],
            [
                'user_id' => 1,
                'año' => 2023,
                'capital_social' => 27000,
                'beneficios' => 4545,
                'excedentes' => 22142,
                'reservas' => 5317,
                'utilidad_ejercicios_ant' => 17870,
            ],
            [
                'user_id' => 1,
                'año' => 2022,
                'capital_social' => 29000,
                'beneficios' => 1985,
                'excedentes' => 9852,
                'reservas' => 3170,
                'utilidad_ejercicios_ant' => 15000,
            ],
            // User 2
            [
                'user_id' => 2,
                'año' => 2024,
                'capital_social' => 29000,
                'beneficios' => 5200,
                'excedentes' => 24000,
                'reservas' => 6200,
                'utilidad_ejercicios_ant' => 20000,
            ],
            [
                'user_id' => 2,
                'año' => 2023,
                'capital_social' => 28000,
                'beneficios' => 4800,
                'excedentes' => 23000,
                'reservas' => 5800,
                'utilidad_ejercicios_ant' => 19000,
            ],
            // User 3
            [
                'user_id' => 3,
                'año' => 2024,
                'capital_social' => 30000,
                'beneficios' => 5500,
                'excedentes' => 30000,
                'reservas' => 7500,
                'utilidad_ejercicios_ant' => 23300,
            ],
        ];

        foreach ($data as $record) {
            Patrimonio::create($record);
        }
    }
}
