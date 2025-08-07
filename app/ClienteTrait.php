<?php

namespace App;

use Illuminate\Support\Facades\Http;

trait ClienteTrait
{
    public function getClienteByDni($dni)
    {
        return Http::get(config('app.peru_dev_url_dni'), [
            'document' => $dni,
            'key' => config('app.peru_dev_token')
        ]);
    }

    public function makeArrayFromApi($response, $dni)
    {
        return [
            "id" => 0,
            "dni_ruc" => $dni,
            'nombres' => $response['resultado']['nombres'] ?? 'No encontrado',
            "apellido_paterno" => $response['resultado']['apellido_paterno'] ?? 'No encontrado',
            "apellido_materno" => $response['resultado']['apellido_materno'] ?? 'No encontrado',
            "genero" => $response['resultado']['genero'] ?? 'No encontrado',
            "fecha_nacimiento" => $response['resultado']['fecha_nacimiento'] ?? 'No encontrado',
            "telefono" => "999999999",
            "email" => "sincorreo@gmail.com",
            "direccion" => "Sin direccion",
        ];
    }
}
