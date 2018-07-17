@extends('layout')

@section('title', "{$title}")

@section('content')
    <h1>Usuario #{{$user->id}}</h1>
    <p>Nombre Usuario:  {{$user->name}}</p>
    <p>Email Usuario:  {{$user->email}}</p>

    <p><a href="{{ url()->previous() }}">Volver</a> </p>
@endsection
