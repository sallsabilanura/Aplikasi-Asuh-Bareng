@props(['title', 'subtitle' => null])

<div class="bg-white py-3 px-5 rounded-xl shadow-sm border border-gray-100 mb-6 flex items-center">
    <div class="w-1.5 h-10 bg-gradient-to-b from-pink-500 to-green-500 rounded-full mr-4"></div>
    <div>
        <h2 class="text-lg font-bold text-gray-800">{{ $title }}</h2>
        @if($subtitle)
            <p class="text-sm text-gray-500 mt-0.5">{{ $subtitle }}</p>
        @endif
    </div>
</div>
