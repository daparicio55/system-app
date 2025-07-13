<?php

namespace Database\Seeders;

use App\Models\Medida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedidaSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medidas = [
            // Cantidad / Unidades
            ['nombre' => 'Unidad', 'abreviatura' => 'UND'],
            ['nombre' => 'Docena', 'abreviatura' => 'DZ'],
            ['nombre' => 'Centena', 'abreviatura' => 'CEN'],
            ['nombre' => 'Millar', 'abreviatura' => 'MIL'],

            // Distancia / Longitud
            ['nombre' => 'Kilómetro', 'abreviatura' => 'km'],
            ['nombre' => 'Hectómetro', 'abreviatura' => 'hm'],
            ['nombre' => 'Decámetro', 'abreviatura' => 'dam'],
            ['nombre' => 'Metro', 'abreviatura' => 'm'],
            ['nombre' => 'Decímetro', 'abreviatura' => 'dm'],
            ['nombre' => 'Centímetro', 'abreviatura' => 'cm'],
            ['nombre' => 'Milímetro', 'abreviatura' => 'mm'],
            ['nombre' => 'Micrómetro', 'abreviatura' => 'μm'],
            ['nombre' => 'Nanómetro', 'abreviatura' => 'nm'],
            ['nombre' => 'Milla', 'abreviatura' => 'mi'],
            ['nombre' => 'Yarda', 'abreviatura' => 'yd'],
            ['nombre' => 'Pie', 'abreviatura' => 'ft'],
            ['nombre' => 'Pulgada', 'abreviatura' => 'in'],

            // Peso / Masa
            ['nombre' => 'Tonelada métrica', 'abreviatura' => 't'],
            ['nombre' => 'Quintal', 'abreviatura' => 'qq'],
            ['nombre' => 'Kilogramo', 'abreviatura' => 'kg'],
            ['nombre' => 'Hectogramo', 'abreviatura' => 'hg'],
            ['nombre' => 'Decagramo', 'abreviatura' => 'dag'],
            ['nombre' => 'Gramo', 'abreviatura' => 'g'],
            ['nombre' => 'Decigramo', 'abreviatura' => 'dg'],
            ['nombre' => 'Centigramo', 'abreviatura' => 'cg'],
            ['nombre' => 'Miligramo', 'abreviatura' => 'mg'],
            ['nombre' => 'Microgramo', 'abreviatura' => 'μg'],
            ['nombre' => 'Libra', 'abreviatura' => 'lb'],
            ['nombre' => 'Onza', 'abreviatura' => 'oz'],

            // Volumen (complementario)
            ['nombre' => 'Metro cúbico', 'abreviatura' => 'm³'],
            ['nombre' => 'Litro', 'abreviatura' => 'L'],
            ['nombre' => 'Mililitro', 'abreviatura' => 'mL'],

            // Tiempo (complementario)
            ['nombre' => 'Segundo', 'abreviatura' => 's'],
            ['nombre' => 'Minuto', 'abreviatura' => 'min'],
            ['nombre' => 'Hora', 'abreviatura' => 'h'],
            ['nombre' => 'Día', 'abreviatura' => 'd'],

            // Más cantidades clásicas
            ['nombre' => 'Par', 'abreviatura' => 'par'],
            ['nombre' => 'Centímetro cúbico', 'abreviatura' => 'cm³'],
            ['nombre' => 'Galón', 'abreviatura' => 'gal'],
            ['nombre' => 'Caja',     'abreviatura' => 'CJA'],
            ['nombre' => 'Paquete',  'abreviatura' => 'PAQ'],
            ['nombre' => 'Bolsa',    'abreviatura' => 'BOL'],
            ['nombre' => 'Lata',     'abreviatura' => 'LAT'],
            ['nombre' => 'Botella',  'abreviatura' => 'BOT'],
            ['nombre' => 'Bulto',    'abreviatura' => 'BLT'],
            ['nombre' => 'Saco',     'abreviatura' => 'SAC'],
        ];
        foreach ($medidas as $medida) {
            Medida::create($medida);
        }
        $this->command->info('Medidas creadas exitosamente.');
    }
}
