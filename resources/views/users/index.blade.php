@extends('layout')

@section('title', "{$title}")

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h2 class="pb-1">{{ $title }} </h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
    </div>
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

                        <td>
                            <form action="{{ route('users.destroy', $user) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <a href="{{ route('users.show', $user) }}" class="btn btn-link"><i class="far fa-eye"></i></a>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-link"><i class="fas fa-edit"></i></a>
                                <button type="submit" class="btn btn-link"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No hay usuarios registrados.</p>
        @endif
@endsection


