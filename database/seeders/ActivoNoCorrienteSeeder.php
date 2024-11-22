<?php

namespace Database\Seeders;

use App\Models\ActivoNoCorriente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivoNoCorrienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'año' => 2024,
                'terrenos' => 26000,
                'edificaciones' => 60000,
                'muebles' => 4000,
            ],
            [
                'user_id' => 1,
                'año' => 2023,
                'terrenos' => 25950,
                'edificaciones' => 53960,
                'muebles' => 3700,
            ],
            [
                'user_id' => 1,
                'año' => 2022,
                'terrenos' => 15950,
                'edificaciones' => 23790,
                'muebles' => 3200,
            ],
            // User 2
            [
                'user_id' => 2,
                'año' => 2024,
                'terrenos' => 27000,
                'edificaciones' => 62000,
                'muebles' => 4500,
            ],
            [
                'user_id' => 2,
                'año' => 2023,
                'terrenos' => 26500,
                'edificaciones' => 58000,
                'muebles' => 4000,
            ],
            // User 3
            [
                'user_id' => 3,
                'año' => 2024,
                'terrenos' => 28000,
                'edificaciones' => 64000,
                'muebles' => 4800,
            ],
        ];

        foreach ($data as $record) {
            ActivoNoCorriente::create($record);
        }
    }
}
