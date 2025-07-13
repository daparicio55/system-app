<?php

namespace Database\Seeders;

use App\Models\Catalogo;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Medida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $caja = Medida::Where('nombre', 'Caja')->first();
        $unidad = Medida::Where('nombre', 'Unidad')->first();
        $satra = Marca::Where('nombre', 'Satra')->first();
        $redes = Categoria::where('nombre', 'Redes')->first();
        $producto1 = Catalogo::create([
            'codigo' => 'CAT-001',
            'nombre' => 'Cable Ethernet Cat 6',
            'descripcion' => 'Cable de red de alta velocidad, ideal para conexiones de internet.',
            'categoria_id' => $redes->id,
            'marca_id' => $satra->id,
            'medida_id' => $caja->id,
            'activo' => true,
            'precio' => 500,
            'contiene' => 300,
            'image_path' => null,
        ]);
        Catalogo::create([
            'codigo' => 'CAT-002',
            'nombre' => 'Cable Ethernet Cat 6',
            'descripcion' => 'Cable de red de alta velocidad, ideal para conexiones de internet.',
            'categoria_id' => $redes->id,
            'marca_id' => $satra->id,
            'medida_id' => $unidad->id,
            'activo' => true,
            'precio' => 2,
            'contiene' => 1,
            'image_path' => null,
            'catalogo_id' => $producto1->id,
        ]);        
    }
}
