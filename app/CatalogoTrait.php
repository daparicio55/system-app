<?php

namespace App;

trait CatalogoTrait
{
    public $array_catalogo = [
        'codigo' => '',
        'nombre' => '',
        'descripcion' => '',
        'categoria_id' => '',
        'marca_id' => '',
        'medida_id' => '',
        'activo' => true,
        'precio' => 0.00,
        'contiene' => 1,
        'image_path' => null,
    ];

    public $modal_create_catalogo = false;
}
