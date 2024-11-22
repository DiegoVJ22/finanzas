<?php

namespace Database\Seeders;

use App\Models\PasivoNoCorriente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasivoNoCorrienteSeeder extends Seeder
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
                'obligaciones_largo_plazo' => 19000,
                'otros_pasivos' => 7000,
            ],
            [
                'user_id' => 1,
                'año' => 2023,
                'obligaciones_largo_plazo' => 18503,
                'otros_pasivos' => 6048,
            ],
            [
                'user_id' => 1,
                'año' => 2022,
                'obligaciones_largo_plazo' => 17405,
                'otros_pasivos' => 4735,
            ],
            // User 2
            [
                'user_id' => 2,
                'año' => 2024,
                'obligaciones_largo_plazo' => 20000,
                'otros_pasivos' => 7500,
            ],
            [
                'user_id' => 2,
                'año' => 2023,
                'obligaciones_largo_plazo' => 19000,
                'otros_pasivos' => 6800,
            ],
            // User 3
            [
                'user_id' => 3,
                'año' => 2024,
                'obligaciones_largo_plazo' => 21000,
                'otros_pasivos' => 8000,
            ],
        ];

        foreach ($data as $record) {
            PasivoNoCorriente::create($record);
        }
    }
}
