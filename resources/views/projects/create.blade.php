@extends('layouts.app')

@section('content')


<div class="w-full max-w-sm justify-center mx-auto mt-6">
    <form action="/projects" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        {{ csrf_field() }}

        <h1 class="mb-4">Create a Project</h1>

        <div class="mb-4">
          
          <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
            Title
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline  {{ $errors->has('title') ? 'border-red' : '' }}" id="title" name="title" type="text" placeholder="Title">
        </div>
        <div class="mb-6">
          <label class="block text-grey-darker text-sm font-bold mb-2" for="description">
            description
          </label>
          <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('description') ? 'border-red' : '' }}" id="description" name="description" rows="3"></textarea>
          
        </div>
        <div class="flex items-center justify-between">
          <input class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Send">
          <a href="/projects" class="bg-red hover:bg-red-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</a>
           
        </div>
      </form>
      <p class="text-center text-grey text-xs">
        ©2019 Andsolucion
      </p>
    </div>
    
  @endsection