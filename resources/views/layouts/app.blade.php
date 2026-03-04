<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('asuh saja.png') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Playfair+Display:wght@500;600&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            /* Custom Scrollbar for horizontal scrolling areas to be visible on mobile */
            .overflow-x-auto::-webkit-scrollbar {
                -webkit-appearance: none;
                height: 6px;
                background-color: transparent;
            }
            .overflow-x-auto::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-radius: 10px;
            }
            .overflow-x-auto::-webkit-scrollbar-thumb {
                background-color: #cbd5e1;
                border-radius: 10px;
                border: 1px solid #f1f5f9;
            }
            .overflow-x-auto::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
            /* Force scrollbar to be visible in some mobile browsers if possible */
            .overflow-x-auto {
                scrollbar-width: thin;
                scrollbar-color: #cbd5e1 transparent;
                -webkit-overflow-scrolling: touch;
            }
        </style>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased text-gray-900" x-data="{ sidebarOpen: false }">
        <div class="flex min-h-screen bg-gray-50">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0">
                <!-- Navbar -->
                <nav class="bg-white border-b border-gray-200 shadow-sm px-4 sm:px-6 py-3 flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Mobile Menu Button -->
                        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 focus:outline-none md:hidden mr-4">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800">
                            {{ $header ?? 'Dashboard' }}
                        </h2>
                    </div>

                    <div class="flex items-center space-x-4">
                        @auth
                        <!-- Profile Dropdown -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center space-x-3 group focus:outline-none">
                                    <div class="text-right hidden sm:block">
                                        <p class="text-sm font-semibold text-gray-800 group-hover:text-pink-600 transition-colors">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                                    </div>
                                    <div class="relative">
                                        @php
                                            $avatarPath = null;
                                            if (Auth::user()->kakakAsuh && Auth::user()->kakakAsuh->Foto) {
                                                $avatarPath = Auth::user()->kakakAsuh->Foto;
                                            } elseif (Auth::user()->avatar) {
                                                $avatarPath = Auth::user()->avatar;
                                            }
                                        @endphp

                                        @if($avatarPath)
                                            <img src="{{ asset('storage/' . $avatarPath) }}" alt="Avatar" class="w-10 h-10 rounded-full object-cover border-2 border-pink-100 group-hover:border-pink-300 transition-all shadow-sm">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center border-2 border-pink-50 group-hover:border-pink-200 transition-all shadow-sm">
                                                <span class="text-pink-400 text-sm font-bold uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 border-b border-gray-100 sm:hidden">
                                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                                </div>
                                
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Lihat Profil') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                        @endauth
                    </div>
                </nav>

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto">
                    <div class="p-4 sm:p-8">
                        <div class="max-w-7xl mx-auto">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
