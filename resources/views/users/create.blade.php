@extends('layout')

@section('title', "Crear Usuario")

@section('content')

    <div class="card">
        <h4 class="card-header">Crear Usuario</h4>
        <div class="card-body">
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
            <form method="post" action="{{ url('usuario/crear') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <button type="submit" class="btn btn-primary">Crear usuario</button>
                <a href="{{ url()->previous() }}" class="btn btn-link">Volver</a>
            </form>
        </div>
    </div>




@endsection
