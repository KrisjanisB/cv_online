<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')


    <!-- Page Content -->
    <main>

        <!-- Session Status -->
        @if(session('status'))
            <div class="pb-2 pt-5 alert" id="#status">
                <div class="max-w-7xl mx-auto px-6 lg:px-8  ">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-3 flex justify-between bg-white font-bolder">
                            <x-auth-session-status :status="session('status')"/>
                            <button class="close-alert hover:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        {{ $slot }}
    </main>
</div>
</body>
</html>
