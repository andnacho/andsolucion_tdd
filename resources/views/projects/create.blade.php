@extends('layouts.app')

@section('content')

    
    <form action="/projects" method="POST" class="container p-4 my-3">

        {{ csrf_field() }}

        <h1 class="mb-4">Create a Project</h1>
        

        <div class="form-group">
          <label for="">Title</label>
          <input type="text"
            class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Title">
          <small id="helpId" class="form-text text-muted">Imagine it</small>
        </div>

        <div class="form-group">
          <label for="description">description</label>
          <textarea class="form-control" name="description" id="description" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send</button>
        <a href="/projects" class="btn btn-secondary">Cancel</a>

    </form>
 
  @endsection