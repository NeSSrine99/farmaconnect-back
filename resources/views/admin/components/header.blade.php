<div class="flex items-center justify-between bg-white shadow-sm px-4 py-3 rounded-xl mb-6">

    {{-- LEFT --}}
    <div class="flex items-center gap-3">

        {{-- MOBILE BUTTON --}}
        <button onclick="toggleMobileSidebar()"
                class="md:hidden text-2xl">
            ☰
        </button>

        {{-- DESKTOP COLLAPSE BUTTON --}}
        <button onclick="toggleDesktopSidebar()"
                class="hidden md:block text-gray-700 text-xl">
            ⬅️
        </button>

        <h2 class="text-lg font-bold text-gray-800">
            @yield('title', 'Dashboard')
        </h2>
    </div>

    {{-- RIGHT --}}
    <div class="flex items-center gap-4">

        <input type="text"
               placeholder="Search..."
               class="hidden md:block border rounded-lg px-3 py-1.5 text-sm">

        <div class="w-8 h-8 rounded-full bg-teal-600 text-white flex items-center justify-center text-sm font-bold">
            A
        </div>

    </div>
</div>