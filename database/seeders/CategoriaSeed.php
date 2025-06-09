<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Electrónica', 'descripcion' => 'Dispositivos electrónicos y gadgets.'],
            ['nombre' => 'Computadoras', 'descripcion' => 'Equipos de escritorio y portátiles.'],
            ['nombre' => 'Componentes', 'descripcion' => 'Partes internas para computadoras y dispositivos.'],
            ['nombre' => 'Periféricos', 'descripcion' => 'Equipos externos como teclados, ratones y monitores.'],
            ['nombre' => 'Accesorios', 'descripcion' => 'Complementos y accesorios variados para equipos.'],
            ['nombre' => 'Suministros', 'descripcion' => 'Materiales consumibles como tóner, papel y cartuchos.'],
            ['nombre' => 'Impresoras', 'descripcion' => 'Dispositivos de impresión y sus repuestos.'],
            ['nombre' => 'Muebles de oficina', 'descripcion' => 'Mobiliario para espacios de trabajo.'],
            ['nombre' => 'Software', 'descripcion' => 'Programas y aplicaciones para diversos usos.'],
            ['nombre' => 'Redes', 'descripcion' => 'Equipos y dispositivos para comunicación y conectividad.'],
        ];
        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
        $this->command->info('Categorías creadas exitosamente.');
    }
}
