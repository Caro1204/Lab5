@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between align-items-center mb-3">
            <h2>Sistema de gestión de tareas</h2> 
            <a class="btn btn-info" href="{{ route('tasks.create') }}">Crear nueva tarea</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Prioridad</th>
                        <th>Completada</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                        <th>Configuraciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            @if ($task->priority == 'baja')
                                <span class="text-success">{{ ucfirst($task->priority) }}</span>
                            @elseif ($task->priority == 'media')
                                <span class="text-warning">{{ ucfirst($task->priority) }}</span>
                            @elseif ($task->priority == 'alta')
                                <span class="text-danger">{{ ucfirst($task->priority) }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($task->completed)
                                <span class="badge bg-info">Completada</span>
                            @else
                                <span class="badge bg-success">Pendiente</span>
                            @endif
                        </td>
                        <td>{{ $task->user ? $task->user->name : 'No User Assigned' }}</td>
                        <td>
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">Completar</button>
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ route('tasks.edit',$task->id) }}">Modificar</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $tasks->links() }}
    </div>
</div>
@endsection
