{{-- resources/views/admin/layout/layout.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Farmaconnect Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>

    <div class="flex">

        {{-- SIDEBAR --}}
        @include('admin.components.sidebar')

        {{-- MAIN --}}
        <div id="mainContent" class="flex-1 min-h-screen transition-all duration-300 ml-0 md:ml-64">
            <div class="p-4 md:p-6">

                {{-- HEADER --}}
                @include('admin.components.header')

                {{-- PAGE CONTENT --}}
                @yield('content')

            </div>
        </div>

    </div>

    <script>
        let sidebarOpen = true;

        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleDesktopSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('mainContent');
            const texts = document.querySelectorAll('.sidebar-text');
            sidebarOpen = !sidebarOpen;

            if (!sidebarOpen) {
                sidebar.classList.replace('w-64', 'w-20');
                main.classList.replace('md:ml-64', 'md:ml-20');
                texts.forEach(t => t.classList.add('hidden'));
            } else {
                sidebar.classList.replace('w-20', 'w-64');
                main.classList.replace('md:ml-20', 'md:ml-64');
                texts.forEach(t => t.classList.remove('hidden'));
            }
        }
    </script>

</body>

</html>
