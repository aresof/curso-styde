<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $title = 'Listado de Usuarios';

        return view('users.index', compact('users', 'title'));
    }

    public function show(User $user){
        $title = 'Usuario #'.$user->id;

        return view('users.show', compact('user','title'));
    }

    public function create(){
        return 'Creando nuevo usuario';
    }

    public function edit($id){
        return "Edición Usuario: {$id}";
    }
}
