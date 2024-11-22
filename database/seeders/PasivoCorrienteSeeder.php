<?php

namespace Database\Seeders;

use App\Models\PasivoCorriente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasivoCorrienteSeeder extends Seeder
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
                'tributos' => 9000,
                'cuentas_por_pagar_comerciales' => 29900,
                'obligaciones' => 2000,
                'cuentas_por_pagar_diversas' => 1800,
            ],
            [
                'user_id' => 1,
                'año' => 2023,
                'tributos' => 8400,
                'cuentas_por_pagar_comerciales' => 29670,
                'obligaciones' => 1900,
                'cuentas_por_pagar_diversas' => 1700,
            ],
            [
                'user_id' => 1,
                'año' => 2022,
                'tributos' => 6700,
                'cuentas_por_pagar_comerciales' => 28100,
                'obligaciones' => 1600,
                'cuentas_por_pagar_diversas' => 2400,
            ],
            // User 2
            [
                'user_id' => 2,
                'año' => 2024,
                'tributos' => 9500,
                'cuentas_por_pagar_comerciales' => 35200,
                'obligaciones' => 2500,
                'cuentas_por_pagar_diversas' => 2000,
            ],
            [
                'user_id' => 2,
                'año' => 2023,
                'tributos' => 8800,
                'cuentas_por_pagar_comerciales' => 25650,
                'obligaciones' => 2100,
                'cuentas_por_pagar_diversas' => 1900,
            ],
            // User 3
            [
                'user_id' => 3,
                'año' => 2024,
                'tributos' => 10000,
                'cuentas_por_pagar_comerciales' => 33000,
                'obligaciones' => 2700,
                'cuentas_por_pagar_diversas' => 2200,
            ],
        ];

        foreach ($data as $record) {
            PasivoCorriente::create($record);
        }
    }
}
