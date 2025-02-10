
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Mi Cuenta</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('account.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>
            {{-- Agrega otros campos según necesites --}}
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection