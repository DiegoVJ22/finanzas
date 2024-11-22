<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create(
            [
            'name' => 'Empresa 1',
            'email' => 'test1@example.com',
            ]
        );
        User::factory()->create(
            [
            'name' => 'Empresa 2',
            'email' => 'test2@example.com',
            ]
        );
        User::factory()->create(
            [
            'name' => 'Empresa 3',
            'email' => 'test3@example.com',
            ]
        );

        $this->call([
        EstadoResultadoSeeder::class,
        ActivoCorrienteSeeder::class,
        ActivoNoCorrienteSeeder::class,
        PasivoCorrienteSeeder::class,
        PasivoNoCorrienteSeeder::class,
        PatrimonioSeeder::class,
    ]);
    }
}
