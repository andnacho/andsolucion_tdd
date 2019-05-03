<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use Illuminate\Http\Request;



class ProjectsController extends Controller
{
    //
    public function index(){

        $projects = auth()->user()->projects;
        return view('projects.index', compact('projects'));
        
    }


    public function show(Project $project, UpdateProjectRequest $request)
    {
//        $this->authorize('update', $project);


        if(\Gate::denies('update', $project)){
            abort(403);
        }


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


    /**
     * @param UpdateProjectRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UpdateProjectRequest $request){


    $project = auth()->user()->projects()->create($request->validated());
        
    //redirect
    return redirect($project->path());

    }



    /**
     * edit
     *
     * @param  Project $project
     *
     * @return void
     */
    public function edit(Project $project)
    {
        
    return view('projects.edit', compact('project'));
    }


    /**
     * @param UpdateProjectRequest $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // if (auth()->user()->isNot($project->owner)){
        //     abort(403);
        // }

        //   $project->update($request->validated());

        $request->persist();

        return redirect($project->path());
    }

    /**
     * 
     *
     * @return array
     */
    protected function validador()
    {   
        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);
    }

   
}
