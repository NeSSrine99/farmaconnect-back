<div id="sidebar"
     class=" fixed z-50 h-full bg-teal-600 text-white
            w-64 transition-all duration-300
            transform -translate-x-full md:translate-x-0">

    {{-- LOGO --}}
    <div class="p-5 border-b border-gray-700">
        <div class="sidebar-text">
            <h1 class="text-xl font-bold">Farmaconnect</h1>
            <p class="text-xs text-gray-400">Admin Panel</p>
        </div>
    </div>

    {{-- MENU --}}
    <nav class="p-3 space-y-1 text-sm">

        <a href="/admin"
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-700">
            <span>🏠</span>
            <span class="sidebar-text">Dashboard</span>
        </a>

        <a href="/admin/products"
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-700">
            <span>📦</span>
            <span class="sidebar-text">Products</span>
        </a>

        <a href="/admin/orders"
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-700">
            <span>🧾</span>
            <span class="sidebar-text">Orders</span>
        </a>

        <a href="/admin/prescriptions"
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-700">
            <span>💊</span>
            <span class="sidebar-text">Prescriptions</span>
        </a>

    </nav>
</div>

{{-- MOBILE OVERLAY --}}
<div id="overlay"
     class="fixed inset-0 bg-black/40 hidden md:hidden"
     onclick="toggleMobileSidebar()"></div>