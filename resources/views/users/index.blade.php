@extends('layout')

@section('title', "{$title}")

@section('content')
    <h2>{{ $title }} </h2>

        @if(!$users->isEmpty())
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Privilegios</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">#{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Administrador' : 'Normal' }}</td>
                        <td><a href="{{ route('users.show', ['id' => $user->id]) }}">Detalle</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No hay usuarios registrados.</p>
        @endif
@endsection


