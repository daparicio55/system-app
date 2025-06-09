<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedore>
 */
class ProveedoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ruc' => $this->faker->unique()->numerify('20#########'), // 11 dígitos comenzando en 20
            'razon_social' => $this->faker->company(),
            'nombre_comercial' => $this->faker->companySuffix(),
            'telefono' => $this->faker->numerify('9########'), // 9 dígitos
            'email' => $this->faker->companyEmail(),
            'direccion' => $this->faker->address(),
            'contacto' => $this->faker->name(),            
        ];
    }
}
