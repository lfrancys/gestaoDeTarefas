<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\Status;

class TaskObserver
{
    /**
     * Handle the Task "creating" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function creating(Task $task)
    {
        $task->status_id = Status::where('name', 'pending')->first()->id;
    }
}
