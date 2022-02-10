@extends('layouts.admin')

@section('content')

    <h1 class="titulo-seccion text-3xl font-thin text-gray-500 mb-3">Editar solicitud</h1>

    @livewire('request-create-edit', ['request' => $request])

@stop
