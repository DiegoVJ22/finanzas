<?php

namespace Database\Seeders;

use App\Models\EstadoResultado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoResultadoSeeder extends Seeder
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
                'ventas' => 260000,
                'saldo_enero' => 40000,
                'compras' => 160000,
                'saldo_diciembre' => -50000,
                'gastos_operacionales' => 45000,
                'gastos_financieros' => 1200,
                'impuesto_renta' => 18000,
            ],
            [
                'user_id' => 1,
                'año' => 2023,
                'ventas' => 248000,
                'saldo_enero' => 36000,
                'compras' => 154000,
                'saldo_diciembre' => -42000,
                'gastos_operacionales' => 40550,
                'gastos_financieros' => 1126,
                'impuesto_renta' => 17497,
            ],
            [
                'user_id' => 1,
                'año' => 2022,
                'ventas' => 200000,
                'saldo_enero' => 24000,
                'compras' => 132000,
                'saldo_diciembre' => -36000,
                'gastos_operacionales' => 30030,
                'gastos_financieros' => 870,
                'impuesto_renta' => 14730,
            ],
            // User 2
            [
                'user_id' => 2,
                'año' => 2024,
                'ventas' => 270000,
                'saldo_enero' => 50000,
                'compras' => 170000,
                'saldo_diciembre' => -60000,
                'gastos_operacionales' => 47000,
                'gastos_financieros' => 1300,
                'impuesto_renta' => 19000,
            ],
            [
                'user_id' => 2,
                'año' => 2023,
                'ventas' => 250000,
                'saldo_enero' => 37000,
                'compras' => 150000,
                'saldo_diciembre' => -45000,
                'gastos_operacionales' => 42000,
                'gastos_financieros' => 1150,
                'impuesto_renta' => 18000,
            ],
            // User 3
            [
                'user_id' => 3,
                'año' => 2024,
                'ventas' => 280000,
                'saldo_enero' => 60000,
                'compras' => 180000,
                'saldo_diciembre' => -70000,
                'gastos_operacionales' => 49000,
                'gastos_financieros' => 1400,
                'impuesto_renta' => 20000,
            ],
        ];

        foreach ($data as $record) {
            EstadoResultado::create($record);
        }
    }
}
