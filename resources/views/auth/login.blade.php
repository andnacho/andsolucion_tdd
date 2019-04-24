@extends('layouts.app')

@section('content')

    <div class="w-full max-w-sm justify-center mx-auto mt-6">
<form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ">
    @csrf
    <div class="mb-4">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
        Email
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline  {{ $errors->has('email') ? 'border-red' : '' }}" id="email" name="email" type="email" placeholder="Username">
    </div>
    <div class="mb-6">
      <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
        Password
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker mb-3 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('password') ? 'border-red' : '' }}" id="password" name="password" type="password" placeholder="******************">
      
    </div>
    <div class="flex items-center justify-between">
      <input class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="Login">
       
      <a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="#">
        Forgot Password?
      </a>
    </div>
  </form>
  <p class="text-center text-grey text-xs">
    ©2019 Andsolucion
  </p>
</div>
   
@endsection
