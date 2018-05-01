<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Jobs\ProcessTodoCount;

class TodoController extends Controller
{
    public function index()
    {
        $allTodo = Todo::all();
        return view('todo', ['allTodo' => $allTodo]);
    }

    public function store(Request $request)
    {
        /**
         * todoテーブルへのデータ保存
         */
        $todo = new Todo;
        $todo->task_name = request('name');
        $todo->save();

        /**
         * todo_historiesテーブル書き込み用のqueueスタック
         */
        $todo_id = $todo->id;
        $task_name_history = request('name');
        $todoQueue = (new ProcessTodoCount($todo_id, $task_name_history));
        dispatch($todoQueue);

        return redirect('/todo');
    }

    public function destroy(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect('/todo');
    }
}
