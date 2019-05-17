@extends('layouts.app')

@section('content')

<header class="flex items-center mb-3 py-4">
     <div class="flex justify-between items-end w-full">
         <p class="text-grey text-sm font-normal">
             <a href="/projects" class="text-gray text-sm font-normal no-underline">My projects</a> / {{ $project->title }}
            </p>

         <div class="flex items-center">

                 <img
                         src="{{ gravatar_url($project->owner->email) }}"
                         alt="{{ $project->owner->name }}"
                         class="rounded-full w-8 mr-2">

             @foreach ($project->members as $member)
                 <img
                         src="{{ gravatar_url($member->email) }}"
                         alt="{{ $member->name }}"
                         class="rounded-full w-8 mr-2">
             @endforeach

                 <a href="{{ $project->path().'/edit' }}" class="button ml-4">Edit project</a>
         </div>
     </div>
</header>

<main>

         <div class="lg:flex -mx-3">
              <div class="lg:w-3/4 px-3 mb-6">
                  <div class="mb-8">
                      <h2 class="text-lg text-grey font-normal mb-1">Tasks</h2>
                        {{--  tasks  --}}
                        @foreach ($project->tasks as $task)
                            
                            <div class="card mb-3">
                                
                                <form method="POST" action="{{ $task->path() }}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="flex">
                                        <input name="body" value="{{$task->body}}" class="w-full {{ $task->completed ? 'text-gray' : '' }}">
                                        <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                    </div>
                                </form>
                            </div>
                                                     
                         @endforeach
                            
                            <div class="card mb-3">
                                <form action="{{ $project->path() . '/tasks' }}" method="POST">
                                    @csrf
                                    <input placeholder="Add a new task" class="w-full" name="body">
                                </form>
                            </div>
                  </div>

                  <div>
                      <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>
                    
                      {{--  General notes  --}}
                      <form method="POST" action="{{ $project->path() }}">
                          {{ csrf_field() }}
                          @method('PATCH')
                          <textarea
                           name="notes"
                           class="card w-full mb-4" 
                           style="min-height:200px" 
                           placeholder="Here you can add some usefull notes"
                           >{{ $project->notes }}</textarea>
                           <button type="submit" class="button">Save</button>
                         
                      </form>

                  </div>
               </div>
               <div class="lg:w-1/4 px-3">
                    <div class="px-3 pb-6 mt-6">
                        @include ('projects.card')

                        @include('projects.activity.card')
                    </div>
                </div>
         </div>

    @if ($errors->any())
        <div class="field mt-5 text-red">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif
    
        </main>


@endsection

