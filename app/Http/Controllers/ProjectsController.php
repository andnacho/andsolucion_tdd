<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    //
    public function index(){
    
    $projects = auth()->user()->projects;

    return view('projects.index', compact('projects'));
        
    }

    /**
     * show
     *
     * @param  mixed $project
     *
     * @return void
     */
    public function show(Project $project)
    {
        $this->authorize('update', $project);
              
        return view('projects.show', compact('project'));

    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
    return view('projects.create');
    }

    public function store(){
    //validate
    $attributes = request()->validate([
        'title' => 'required',
        'description' => 'required',
        'notes' => 'min:3'
        ]);

    
    //persist
    $project = auth()->user()->projects()->create($attributes);
    

    //redirect
    return redirect($project->path());

    }

    /**
     * update
     *
     * @param  Project $project
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Project $project)
    {

        $this->authorize('update', $project);

        // if (auth()->user()->isNot($project->owner)){
        //     abort(403);
        // }

        $project->update(request(['notes']));

        return redirect($project->path());
    }

}
