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

    public function show(User $user)
    {
        $title = 'Usuario #'.$user->id;

        return view('users.show', compact('user','title'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min:6']
            ],
            [
                'name.required' => 'El campo nombre es obligatorio',
                'email.required' => 'El campo email es obligatorio',
                'email.email' => 'El campo email no es válido',
                'email.unique' => 'El email ya está registrado',
                'password.required' => 'El campo password es obligatorio',
                'password.min' => 'El password debe tener mínimo 6 caracteres'
            ]
        );


        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect('usuarios');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate(
            [
                'name' => 'required',
                'email' => ['required', 'email', 'unique:users,email,'.$user->id],
                'password' => 'nullable', 'min:6'
            ],
            [
                'name.required' => 'El campo nombre es obligatorio',
                'email.required' => 'El campo email es obligatorio',
                'email.email' => 'El campo email no es válido',
                'email.unique' => 'El email ya está registrado',
                'password.required' => 'El campo password es obligatorio',
                'password.min' => 'El password debe tener mínimo 6 caracteres'
            ]
        );

        if($data['password'] != null)
            $data['password'] = bcrypt($data['password']);
        else unset($data['password']);

        $user->update($data);

        return redirect()->route('users.show', compact('user'));
    }

    public function destroy (User $user)
    {
        $user->delete();

        return redirect()->route('users');
    }
}
