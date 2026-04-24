<aside id="sidebar"
    class="fixed top-0 left-0 h-screen w-64 bg-white shadow-xl z-50 flex flex-col transition-all duration-300 transform -translate-x-full md:translate-x-0"
    style="font-family: 'Plus Jakarta Sans', sans-serif;">

    {{-- OVERLAY (mobile) --}}
    <div id="overlay" onclick="toggleMobileSidebar()"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 hidden md:hidden"></div>

    {{-- LOGO --}}
    <div class="flex items-center gap-3 px-6 py-5 border-b border-gray-100">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center shadow-md"
            style="background: linear-gradient(135deg, #06b6d4, #3b82f6);">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.78 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
            </svg>
        </div>
        <div>
            <span class="sidebar-text font-bold text-gray-800 text-base tracking-tight">Farmaconnect</span>
            <span class="sidebar-text block text-xs text-cyan-500 font-medium">Admin Panel</span>
        </div>
    </div>

    {{-- NAV --}}
    <nav class="flex-1 px-4 py-5 overflow-y-auto">

        <p class="sidebar-text text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3 px-2">General</p>

        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1 font-medium text-sm transition-all duration-200
            {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-md shadow-cyan-200' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="sidebar-text">Dashboard</span>
        </a>

        <a href="{{ route('admin.products.index') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1 font-medium text-sm transition-all duration-200
            {{ request()->routeIs('admin.products*') ? 'bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-md shadow-cyan-200' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <span class="sidebar-text">Products</span>
        </a>

        <a href="{{ route('admin.orders') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1 font-medium text-sm transition-all duration-200
            {{ request()->routeIs('admin.orders*') ? 'bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-md shadow-cyan-200' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <span class="sidebar-text">Orders</span>
            @if (isset($pendingOrders) && $pendingOrders > 0)
                <span
                    class="sidebar-text ml-auto bg-red-100 text-red-500 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $pendingOrders }}</span>
            @endif
        </a>

        <a href="{{ route('admin.prescriptions') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1 font-medium text-sm transition-all duration-200
            {{ request()->routeIs('admin.prescriptions*') ? 'bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-md shadow-cyan-200' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="sidebar-text">Prescriptions</span>
        </a>


        <a href="{{ route('admin.consultations') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1 font-medium text-sm transition-all duration-200
    {{ request()->routeIs('admin.consultations*') ? 'bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-md shadow-cyan-200' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">

            <!-- 💬 NEW CHAT ICON -->
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 8h10M7 12h6m-6 4h4m10-4c0 4-4 7-9 7a9 9 0 01-4-.8L3 20l1.5-3A7 7 0 013 12c0-4 4-7 9-7s9 3 9 7z" />
            </svg>

            <span class="sidebar-text">Consultations</span>

        </a>


        <a href="{{ route('admin.subscriptions') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1 font-medium text-sm transition-all duration-200
    {{ request()->routeIs('admin.subscriptions*') ? 'bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-md shadow-cyan-200' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">

            <!-- 💬 NEW CHAT ICON -->
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v6h6M20 20v-6h-6M5.64 18.36A9 9 0 1018.36 5.64L20 8M4 16l1.64 2.36" />
            </svg>

            <span class="sidebar-text">Subscriptions</span>

        </a>

        <p class="sidebar-text text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3 mt-5 px-2">Settings
        </p>

        <a href="{{ route('admin.users.index') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1 font-medium text-sm transition-all duration-200
            {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-cyan-500 to-blue-500 text-white shadow-md shadow-cyan-200' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="sidebar-text">Users</span>
        </a>

        <a href="{{ route('admin.team') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1 font-medium text-sm transition
    {{ request()->routeIs('admin.team') ? 'bg-gradient-to-r from-cyan-500 to-blue-500  text-white' : 'text-gray-500 hover:bg-gray-50' }}">

            {{-- ICON (users group) --}}
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5-2.83M9 20H4v-2a3 3 0 015-2.83M12 12a4 4 0 100-8 4 4 0 000 8zM17 12a4 4 0 100-8 4 4 0 000 8zM7 12a4 4 0 100-8 4 4 0 000 8z" />
            </svg>

            <span class="sidebar-text">Team</span>
        </a>

        <a href="#"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1 font-medium text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-800 transition-all duration-200">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="sidebar-text">Settings</span>
        </a>

        <a href="#"
            class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl mb-1 font-medium text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-800 transition-all duration-200">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span class="sidebar-text">Support</span>
        </a>

    </nav>

    {{-- LOGOUT --}}
    <div class="px-4 py-4 border-t border-gray-100">
        <form method="POST">
            @csrf
            <button type="submit"
                class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-xl font-medium text-sm text-red-400 hover:bg-red-50 hover:text-red-600 transition-all duration-200">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="sidebar-text">Log Out</span>
            </button>
        </form>
    </div>

</aside>
