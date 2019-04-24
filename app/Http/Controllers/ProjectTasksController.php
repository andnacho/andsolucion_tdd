<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    /**
     * store
     *
     * @param  Project $project
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Project $project)
    {
      
        $this->authorize('update', $project);

        request()->validate(['body' => 'required']);
        $project->addTask(request('body'));

        return redirect($project->path());
    }

    /**
     * update
     *
     * @param  Project $project
     * @param  Task $task
     *
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Project $project, Task $task)
    {   
         $this->authorize('update', $task->project);

        request()->validate(['body' => 'required']);
      
        $task->update([
            'body' => request('body'),
            'completed' => request()->has('completed')
        ]);


        return redirect($project->path());
    }
}
