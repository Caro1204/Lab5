@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-center">Editar Tarea</div>

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

                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" name="title" value="{{ $task->title }}" class="form-control" placeholder="Título">
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label">Prioridad</label>
                            <select name="priority" class="form-control">
                                <option value="baja" @if($task->priority == 'baja') selected @endif>Baja</option>
                                <option value="media" @if($task->priority == 'media') selected @endif>Media</option>
                                <option value="alta" @if($task->priority == 'alta') selected @endif>Alta</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="completed" class="form-label">Completado</label>
                            <select name="completed" class="form-control">
                                <option value="0" @if(!$task->completed) selected @endif>Pendiente</option>
                                <option value="1" @if($task->completed) selected @endif>Completada</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2 d-md-block text-center">
                            <button type="submit" class="btn btn-success">Enviar</button>
                            <a class="btn btn-warning" href="{{ route('tasks.index') }}">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
