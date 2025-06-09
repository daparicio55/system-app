<?php

namespace Database\Seeders;

use App\Models\Proveedore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedoreSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedore::factory()->count(1200)->create();
    }
}
