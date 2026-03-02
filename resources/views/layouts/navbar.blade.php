<nav class="bg-white border-b border-gray-200 shadow-sm px-6 py-3 flex justify-between items-center">
    <div class="flex items-center">
        <!-- Dashboard Title or Breadcrumb could go here -->
        <h2 class="text-xl font-semibold text-gray-800">
            @yield('header', 'Dashboard')
        </h2>
    </div>
    
    <div class="flex items-center space-x-4">
        <div class="text-right mr-3">
            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">Log Out</button>
        </form>
    </div>
</nav>
