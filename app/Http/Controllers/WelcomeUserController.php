<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function saludo_simple($name)
    {
        $name = ucfirst($name);

        return "Bienvenido {$name}";
    }
    public function saludo_compuesto($name, $nickname)
    {
        $name = ucfirst($name);

        return "Bienvenido {$name}, tu apodo es {$nickname}";
    }
}
