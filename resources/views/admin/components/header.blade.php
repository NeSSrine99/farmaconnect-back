

<header class="flex items-center justify-between bg-white px-6 py-4 rounded-2xl shadow-sm mb-6"
    style="font-family: 'Plus Jakarta Sans', sans-serif;">

    {{-- LEFT: Hamburger + Search --}}
    <div class="flex items-center gap-4">

        {{-- Mobile Toggle --}}
        <button onclick="toggleMobileSidebar()"
            class="md:hidden p-2 rounded-xl hover:bg-gray-100 text-gray-500 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- Desktop Collapse Toggle --}}
        <button onclick="toggleDesktopSidebar()"
            class="hidden md:flex p-2 rounded-xl hover:bg-gray-100 text-gray-500 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
        </button>

        {{-- Search --}}
        <div class="relative hidden sm:block">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input type="text" placeholder="What are you searching..."
                class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:border-transparent w-64 transition" />
        </div>

    </div>

    {{-- RIGHT: Notifications + Profile --}}
    <div class="flex items-center gap-3">

        {{-- Notifications Bell --}}
        <button class="relative p-2 rounded-xl hover:bg-gray-100 text-gray-500 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-400 rounded-full ring-2 ring-white"></span>
        </button>

        {{-- Messages --}}
        <button class="relative p-2 rounded-xl hover:bg-gray-100 text-gray-500 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-4 4v-4z" />
            </svg>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-cyan-400 rounded-full ring-2 ring-white"></span>
        </button>

        {{-- Divider --}}
        <div class="w-px h-8 bg-gray-200 mx-1"></div>

        {{-- Profile --}}
        <div class="flex items-center gap-3 cursor-pointer group">
            <div class="w-9 h-9 rounded-xl overflow-hidden ring-2 ring-cyan-100 group-hover:ring-cyan-300 transition">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=06b6d4&color=fff&bold=true"
                    alt="Admin Avatar" class="w-full h-full object-cover" />
            </div>
            <div class="hidden md:block">
                <p class="text-sm font-semibold text-gray-800 leading-tight">{{ auth()->user()->name ?? 'Admin' }}</p>
                <p class="text-xs text-gray-400 leading-tight capitalize">{{ auth()->user()->role ?? 'Administrator' }}</p>
            </div>
            <svg class="w-4 h-4 text-gray-400 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>

    </div>

</header>