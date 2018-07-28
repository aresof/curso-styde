@extends('layout')

@section('title', "Editar Usuario")

@section('content')
    <h1>Editar usuario</h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <h5>Por favor corrige los siguientes errores: </h5>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ url("usuario/{$user->id}") }}">
        {{ method_field('put') }}
        {{ csrf_field() }}

        <p><label for="name">Nombre</label></p>
        <p><input type="text" name="name" id="name" value="{{ old('name',$user->name) }}"></p>
        <p><label for="email">Email</label></p>
        <p><input type="email" name="email" id="email" value="{{ old('email',$user->email) }}"></p>
        <p><label for="password">Password</label></p>
        <p><input type="password" name="password" id="password"></p>

        <button type="submit">Actualizar usuario</button>

    </form>

    <p><a href="{{ url()->previous() }}">Volver</a> </p>
@endsection
