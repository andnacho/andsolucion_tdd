@extends('layouts.app')

@section('content')

    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-default text-sm font-normal">
                <a href="/projects" class="text-default text-sm font-normal no-underline">My projects</a>
                / {{ $project->title }}
            </p>

            <div class="flex items-center">


                @foreach ($project->members as $member)
                    <img
                            src="{{ gravatar_url($member->email) }}"
                            alt="{{ $member->name }}"
                            class="rounded-full w-8 mr-2">
                @endforeach

                    <img
                            src="{{ gravatar_url($project->owner->email) }}"
                            alt="{{ $project->owner->name }}"
                            class="rounded-full w-8 mr-2">

                    <a href="{{ $project->path().'/edit' }}" class="button mr-2 ml-4">Edit project</a>
            </div>
        </div>
    </header>

    <main>

        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-default font-normal mb-1">Tasks</h2>
                    {{--  tasks  --}}
                    @foreach ($project->tasks as $task)

                        <div class="card mb-3">

                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input name="body" value="{{$task->body}}"
                                           class="bg-card text-default w-full {{ $task->completed ? 'line-through task' : '' }}">
                                    <input type="checkbox" name="completed"
                                           onChange="this.form.submit()" {{ $task->completed ? "checked" : '' }} >
                                    <span class="checkmark"></span>
                                </div>
                            </form>

                        </div>

                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input placeholder="Add a new task" class="bg-card text-default w-full" name="body">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg text-default font-normal mb-3">General Notes</h2>

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


                    @include ('errors')

                </div>
            </div>

            <div class="lg:w-1/4 px-3">
                <div class="px-3 pb-6 mt-6">
                    @include ('projects.card')
                    @include('projects.activity.card')

                    @can('manage', $project)
                        @include('projects.invite')
                    @endcan

                </div>
            </div>
        </div>

    </main>


@endsection

