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

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
        User::create([
            'name' => 'Dave',
            'email' => 'daparicio@idexperujapon.edu.pe',
            'password' => bcrypt('12345678'),
        ]);
        $this->call(LocaleSeed::class);
        $this->call(ProveedoreSeed::class);
        $this->call(MarcaSeed::class);
        $this->call(MedidaSeed::class);
        $this->call(CategoriaSeed::class);
        $this->call(CatalogoSeed::class);
    }
}
