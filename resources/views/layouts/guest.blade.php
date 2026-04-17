<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-200 antialiased bg-space-grid">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                @php $profile = \App\Models\Profile::first(); @endphp
                <a href="/" class="text-3xl font-bold tracking-tighter text-white flex items-center gap-2" style="text-decoration: none;">
                    @if($profile && $profile->logo_image)
                        <img src="{{ asset('storage/' . $profile->logo_image) }}" alt="Logo" class="h-12 object-contain">
                    @else
                        <div class="relative w-12 h-12 flex items-center justify-center mr-2">
                            <div class="absolute inset-0 bg-gradient-to-tr from-cyan-400 to-blue-600 rounded-xl transform rotate-45 blur-sm opacity-60 animate-pulse"></div>
                            <div class="absolute inset-0 bg-gradient-to-tr from-cyan-400 to-blue-600 rounded-xl transform rotate-45 border border-white/30 shadow-[0_0_20px_rgba(56,189,248,0.6)]"></div>
                            <span class="relative z-10 text-white text-sm font-extrabold tracking-widest drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">TH</span>
                        </div>
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400 font-extrabold drop-shadow-[0_2px_10px_rgba(255,255,255,0.2)]">Theo<span class="text-cyan-400">.</span></span>
                    @endif
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 glass-panel overflow-hidden sm:rounded-[2rem]">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
