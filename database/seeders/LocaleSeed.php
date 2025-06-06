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
                'nombre' => 'Local 1'
            ],
            [
                'codigo' => '002',
                'nombre' => 'Local 2'
            ],
            [
                'codigo' => '003',
                'nombre' => 'Local 3'
            ],
            [
                'codigo' => '004',
                'nombre' => 'Local 4'
            ],
            [
                'codigo' => '005',
                'nombre' => 'Local 5'
            ]
        ];
        foreach ($locales as $locale) {
            Locale::create($locale);
        }        
    }
}
