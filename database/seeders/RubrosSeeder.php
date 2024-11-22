<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RubrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rubros = [
            ['detalle' => 'Tecnología de la Información'],
            ['detalle' => 'Salud y Medicina'],
            ['detalle' => 'Educación'],
            ['detalle' => 'Construcción'],
            ['detalle' => 'Turismo y Hotelería'],
            ['detalle' => 'Alimentación y Bebidas'],
            ['detalle' => 'Textiles y Moda'],
            ['detalle' => 'Finanzas y Banca'],
            ['detalle' => 'Transporte y Logística'],
            ['detalle' => 'Energía y Recursos Naturales'],
            ['detalle' => 'Automotriz'],
            ['detalle' => 'Medios de Comunicación'],
            ['detalle' => 'Bienes Raíces'],
            ['detalle' => 'Consultoría'],
            ['detalle' => 'Publicidad y Marketing'],
            ['detalle' => 'Agricultura y Ganadería'],
            ['detalle' => 'Telecomunicaciones'],
            ['detalle' => 'Manufactura'],
            ['detalle' => 'Servicios Públicos'],
            ['detalle' => 'Deportes y Recreación'],
            ['detalle' => 'Ambiental'],
            ['detalle' => 'Legal y Jurídico'],
            ['detalle' => 'Comercio Minorista'],
            ['detalle' => 'Comercio Mayorista'],
            ['detalle' => 'Seguridad y Vigilancia'],
            ['detalle' => 'Arte y Cultura'],
            ['detalle' => 'ONG y Servicios Sociales'],
            ['detalle' => 'Recursos Humanos'],
            ['detalle' => 'Ingeniería'],
            ['detalle' => 'Aeronáutica y Aeroespacial'],
            ['detalle' => 'Minería'],
            ['detalle' => 'Farmacéutica'],
            ['detalle' => 'Biotecnología'],
            ['detalle' => 'Transporte Marítimo'],
            ['detalle' => 'Transporte Aéreo'],
            ['detalle' => 'Seguros'],
            ['detalle' => 'Química'],
            ['detalle' => 'Electrónica y Electrodomésticos'],
            ['detalle' => 'Logística y Cadena de Suministro'],
            ['detalle' => 'Muebles y Decoración'],
        ];

        DB::table('rubros')->insert($rubros);
    }
}
