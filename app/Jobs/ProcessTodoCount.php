<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\TodoHistory;
use Illuminate\Support\Facades\Log;

class ProcessTodoCount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $todo_id;
    protected $task_name_history;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($todo_id, $task_name_history)
    {
        $this->todo_id = $todo_id;
        $this->task_name_history = $task_name_history;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Queueジョブ処理開始');

        $todoHistory = new TodoHistory;
        $todoHistory->todo_id = $this->todo_id;
        $todoHistory->task_name_history = $this->task_name_history;
        $todoHistory->save();

        Log::info('Queueジョブ処理終了');
    }
}
