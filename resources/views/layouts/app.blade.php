<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="theme-light bg-page">
<div id="app">
    <nav class="bg-header">
        <div class="container mx-auto">
            <div class="flex justify-between items-center py-2">

                <h1>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        @include('logo.logo')
                    </a>
                </h1>


                <div>

                    <!-- Right Side Of Navbar -->
                    <div class="flex items-center ml-auto list-reset">
                        <!-- Authentication Links -->
                        @guest
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else

                            <theme-switcher></theme-switcher>

                            <dropdown align="right" width="200px">
                                <template v-slot:trigger>
                                    <button class="flex">
                                        <div id="" class="nav-link" href="#" role="button">
                                            <img src="https://gravatar.com/avatar/{{md5('andnachocas@gmail.com')}}?s=60"
                                                 class="rounded-full"><span class="caret"></span>
                                        </div>

                                        <div class="flex ml-5 mr-8 h-16">
                                            <div class="no-underline ml-1 my-auto text-default">
                                                {{ucfirst(auth()->user()->name)}}
                                            </div>

                                        </div>
                                    </button>

                                </template> 

                                <template v-slot:default>
                                    <a class="dropdown-menu-link"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">Logout</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>

                                </template>

                            </dropdown>

                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
