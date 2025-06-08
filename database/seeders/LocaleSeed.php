<?php

namespace Database\Seeders;

use App\Models\Locale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class LocaleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $locales = [
            [
                'codigo' => '001',
                'nombre' => 'Local 1',
                'direccion' => 'Calle Falsa 123',
                'telefono' => '1234567890'
            ],
            [
                'codigo' => '002',
                'nombre' => 'Local 2',
                'direccion' => 'Avenida Siempre Viva 456',
                'telefono' => '0987654321'
            ],
            [
                'codigo' => '003',
                'nombre' => 'Local 3',
                'direccion' => 'Boulevard de los Sueños Rotos 789',
                'telefono' => '1122334455'
            ],
            [
                'codigo' => '004',
                'nombre' => 'Local 4',
                'direccion' => 'Plaza Mayor 101',
                'telefono' => '5566778899'
            ],
            [
                'codigo' => '005',
                'nombre' => 'Local 5',
                'direccion' => 'Calle del Sol 202',
                'telefono' => '2233445566'
            ]
        ];
        foreach ($locales as $locale) {
            Locale::create($locale);
        }        
    }
}
