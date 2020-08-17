<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   

    <title>{{ config('app.name', 'AFG Viet Nam') }}
        
        @hasSection('title')     
           - @yield('title')

        @else
        - AFG Viet Nam
        @endif

    </title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flag-icon-css/css/flag-icon.min.css') }}">


    <!-- Styles -->
    <link href="{{ asset('css/frontend/overrides.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend/login.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">
    <script src="{{ asset('js/alert.js') }}"></script>
    @stack('styles')
</head>
<body>
    <div id="app">
        <div class="wrapper">
            @include ('partials.messages')
            <header id="header" class="@if(Route::currentRouteName() == 'home')home @endif">
                <div class="container">
                    @include('frontend._include.header')
                </div>
            </header>
      
            <main id="main">
                
                @yield('content')
            </main>
    
            <footer id="footer">
                @include('frontend._include.footer')
            </footer>
    </div>
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
