<?php

namespace App;

use Illuminate\Support\Facades\Http;

trait ProveedoreTrait
{
    //
    public function getProveedoreByRuc($ruc)
    {
        return Http::get(config('app.peru_dev_url_ruc'), [
            'document' => $ruc,
            'key' => config('app.peru_dev_token')
        ]);
    }

    public function makeArrayFromApi($response, $ruc)
    {
        return [
            "id" => 0,
            "ruc" => $ruc,
            "razon_social" => $response['resultado']['razon_social'] ?? 'No encontrado',
            "nombre_comercial" => $response['resultado']['nombre_comercial'] ?? '-',
            "telefono" => "987456123",
            "email" => "sincorreo@gmail.com",
            "direccion" => $response['resultado']['departamento'] . ' - ' . $response['resultado']['provincia'] . ' - ' . $response['resultado']['distrito'] . ' - ' . $response['resultado']['direccion'] ?? 'No encontrado',
            "contacto" => "Sin contato",
        ];
    }
}
