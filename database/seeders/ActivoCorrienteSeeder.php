<?php

namespace Database\Seeders;

use App\Models\ActivoCorriente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivoCorrienteSeeder extends Seeder
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
                'efectivo' => 3000,
                'inversion' => 16000,
                'cuentas_por_cobrar' => 40000,
                'mercaderias' => 45000,
                'servicios' => 1500,
            ],
            [
                'user_id' => 1,
                'año' => 2023,
                'efectivo' => 2050,
                'inversion' => 15450,
                'cuentas_por_cobrar' => 39712,
                'mercaderias' => 42000,
                'servicios' => 1100,
            ],
            [
                'user_id' => 1,
                'año' => 2022,
                'efectivo' => 2500,
                'inversion' => 12560,
                'cuentas_por_cobrar' => 39292,
                'mercaderias' => 56000,
                'servicios' => 1025,
            ],
            // User 2
            [
                'user_id' => 2,
                'año' => 2024,
                'efectivo' => 3500,
                'inversion' => 17000,
                'cuentas_por_cobrar' => 42000,
                'mercaderias' => 46000,
                'servicios' => 1800,
            ],
            [
                'user_id' => 2,
                'año' => 2023,
                'efectivo' => 2200,
                'inversion' => 15700,
                'cuentas_por_cobrar' => 41000,
                'mercaderias' => 43000,
                'servicios' => 1300,
            ],
            // User 3
            [
                'user_id' => 3,
                'año' => 2024,
                'efectivo' => 4000,
                'inversion' => 18000,
                'cuentas_por_cobrar' => 45000,
                'mercaderias' => 47000,
                'servicios' => 2000,
            ],
        ];

        foreach ($data as $record) {
            ActivoCorriente::create($record);
        }
    }
}
