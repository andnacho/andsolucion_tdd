<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>Laravel</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
      </head>
      <body>
        
        <nav class="sticky-top">
          <div class="title m-b-md text-center">
            <button class="btn btn-primary my-2" id="blue">Azul</button>
            <button class="btn btn-primary my-2" id="red">Rojo</button>
            <button class="btn btn-primary my-2" id="gray">Gris</button>
            <button class="btn btn-primary my-2" id="orange">Naranja</button>
            <button class="btn btn-primary my-2" id="green">Gris</button>
          </nav>
          
          
          <div id="demo">
            <button v-on:click="show = !show">
              Toggle
            </button>
            <transition name="fade">
              <p v-if="show">hello</p>
            </transition>
          </div>
          

          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

          <script rel="stylesheet" src="{{ asset('js/vue.js') }}"></script>
          <script>
            new Vue({
              el: '#demo',
              data: {
                show: true
              }
            })
            
          </script>
          
        </body>
        </html>
        