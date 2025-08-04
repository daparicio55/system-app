<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('usuarios.ventas.index');
    }

    public function create()
    {
        return view('usuarios.ventas.create');
    }
}
