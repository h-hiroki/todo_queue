@extends('layout')

@section('content')
    <h1>Todo List</h1>
    <form action="/todo" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <!-- Todo Name -->
        <div class="form-group">
            <label for="todo" class="col-sm-3 control-label">Todo</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="todo-name" class="form-control">
            </div>
        </div>

        <!-- Add Todo Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Add
                </button>
            </div>
        </div>
    </form>

    <!-- Current Todos -->
    <h2>Current Todo</h2>
    <table class="table table-striped todo-table">
        <thead>
            <th>Todo</th><th>&nbsp;</th>
        </thead>

        <tbody>
            @foreach ($allTodo as $todo)
                <tr>
                    <!-- Todo Name -->
                    <td>
                        <div>{{ $todo->task_name }}</div>
                    </td>
                    <td>
                        <form action="/todo/{{ $todo->id }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
