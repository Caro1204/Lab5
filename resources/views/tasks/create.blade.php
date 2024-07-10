@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6"> <!-- Se ha reducido a col-md-6 para un diseño más compacto -->
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">Crear una Nueva Tarea</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>¡Vaya!</strong> Hubo algunos problemas con su entrada.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" name="title" class="form-control" placeholder="Título" required>
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label">Prioridad</label>
                            <select name="priority" class="form-select" required>
                                <option value="baja">Baja</option>
                                <option value="media" selected>Media</option>
                                <option value="alta">Alta</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">Asignar Usuario</label>
                            <select name="user_id" class="form-select">
                                <option value="">Ninguno</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-success me-md-2">Guardar</button>
                            <a class="btn btn-dark" href="{{ route('tasks.index') }}">Regresar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
