@php
use Illuminate\Support\Facades\Auth;
@endphp
<!-- Mobile Menu Overlay -->
<div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" onclick="closeMobileMenu()"></div>

<!-- Mobile Sidebar Menu -->
<div id="mobile-menu" class="fixed top-0 left-0 h-full w-72 sm:w-80 bg-white shadow-2xl z-50 transform -translate-x-full transition-transform duration-300 ease-in-out">
    <div class="flex flex-col h-full">
        <!-- Mobile Menu Header -->
        <div class="bg-red-700 p-1">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-12" style="object-fit: contain; width: 25%; height: 25%;" loading="eager">
                    <div class="">
                        <span class="text-white font-bold text-lg">CRIME</span>
                        <span class="text-yellow-500 font-bold text-lg">WATCH.ID</span>
                    </div>
                </div>
                <button class="text-white" onclick="closeMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Search and Login -->
        <div class="p-4 border-b">
            <div class="space-y-4">
                <div class="relative">
                    <input type="text" 
                        placeholder="Apa yang kamu cari?" 
                        class="w-full rounded-full py-2 px-6 text-sm focus:outline-none border"
                    >
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
                @auth
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600">Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span></p>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full bg-red-700 text-white px-6 py-2 rounded-full font-medium hover:bg-red-800 block text-center">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="w-full bg-red-700 text-white px-6 py-2 rounded-full font-medium hover:bg-red-800 block text-center">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Navigation -->
        <nav class="flex-1 overflow-y-auto">
            <ul class="px-4 py-2 space-y-1">
                <li><a href="/" class="text-gray-800 py-3 block hover:text-red-600 font-medium text-sm border-b">NEWS</a></li>
                <li><a href="{{ route('category.detail', 'polri') }}" class="text-gray-800 py-3 block hover:text-red-600 font-medium text-sm border-b">POLRI</a></li>
                <li><a href="{{ route('category.detail', 'kriminal') }}" class="text-gray-800 py-3 block hover:text-red-600 font-medium text-sm border-b">KRIMINAL</a></li>
                <li><a href="{{ route('category.detail', 'bhabin') }}" class="text-gray-800 py-3 block hover:text-red-600 font-medium text-sm border-b">BHABIN</a></li>
                <li><a href="{{ route('category.detail', 'lantas') }}" class="text-gray-800 py-3 block hover:text-red-600 font-medium text-sm border-b">LANTAS</a></li>
                <li><a href="{{ route('category.detail', 'politik') }}" class="text-gray-800 py-3 block hover:text-red-600 font-medium text-sm border-b">POLITIK</a></li>
                <li><a href="{{ route('category.detail', 'ragam') }}" class="text-gray-800 py-3 block hover:text-red-600 font-medium text-sm border-b">RAGAM</a></li>
                <li><a href="{{ route('category.detail', 'indeks') }}" class="text-gray-800 py-3 block hover:text-red-600 font-medium text-sm border-b">INDEKS</a></li>
            </ul>
        </nav>
    </div>
</div>

<!-- Main Header -->
<header>
    <!-- Upper Header -->
    <div class="bg-red-700">
        <div class="container mx-auto px-4 py-1">
            <div class="flex items-center justify-between">
                <!-- Logo and Menu Button -->
                <div class="flex items-center space-x-4">
                    <button class="md:hidden text-white" onclick="toggleMobileMenu()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-16 6h16"></path>
                        </svg>
                    </button>
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16" style="object-fit: contain;" loading="eager">
                        <div class="">
                            <span class="text-white font-bold text-xl md:text-2xl">CRIME</span>
                            <span class="text-yellow-500 font-bold text-xl md:text-2xl">WATCH.ID</span>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Search and Login -->
                <div class="hidden md:flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" 
                            placeholder="Apa yang kamu cari?" 
                            class="w-[400px] rounded-full py-2 px-6 text-sm focus:outline-none"
                        >
                        <button class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                    @auth
                        <div class="flex items-center space-x-3">
                            <span class="text-white text-sm">Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span></span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="bg-white text-red-700 px-4 py-2 rounded-full font-medium hover:bg-gray-100 text-sm">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- <a href="{{ route('login') }}" class="bg-white text-red-700 px-6 py-2 rounded-full font-medium hover:bg-gray-100">
                            
                        </a> -->
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Navigation -->
    <nav class="bg-red-700 border-t border-red-800 hidden md:block">
        <div class="container mx-auto">
            <ul class="flex justify-center space-x-8 lg:space-x-12">
                <li><a href="/" class="text-white py-3 inline-block hover:text-yellow-500 font-medium text-sm tracking-wide">NEWS</a></li>
                <li><a href="{{ route('category.detail', 'polri') }}" class="text-white py-3 inline-block hover:text-yellow-500 font-medium text-sm tracking-wide">POLRI</a></li>
                <li><a href="{{ route('category.detail', 'kriminal') }}" class="text-white py-3 inline-block hover:text-yellow-500 font-medium text-sm tracking-wide">KRIMINAL</a></li>
                <li><a href="{{ route('category.detail', 'bhabin') }}" class="text-white py-3 inline-block hover:text-yellow-500 font-medium text-sm tracking-wide">BHABIN</a></li>
                <li><a href="{{ route('category.detail', 'lantas') }}" class="text-white py-3 inline-block hover:text-yellow-500 font-medium text-sm tracking-wide">LANTAS</a></li>
                <li><a href="{{ route('category.detail', 'politik') }}" class="text-white py-3 inline-block hover:text-yellow-500 font-medium text-sm tracking-wide">POLITIK</a></li>
                <li><a href="{{ route('category.detail', 'ragam') }}" class="text-white py-3 inline-block hover:text-yellow-500 font-medium text-sm tracking-wide">RAGAM</a></li>
                <li><a href="{{ route('category.detail', 'indeks') }}" class="text-white py-3 inline-block hover:text-yellow-500 font-medium text-sm tracking-wide">INDEKS</a></li>
            </ul>
        </div>
    </nav>
</header>

<script>
    function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-overlay');
        const body = document.body;
        
        mobileMenu.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        body.classList.toggle('overflow-hidden');
    }

    function closeMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-overlay');
        const body = document.body;
        
        mobileMenu.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        body.classList.remove('overflow-hidden');
    }
</script>
