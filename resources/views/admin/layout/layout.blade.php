<!DOCTYPE html>
<html>

<head>
    <title>Farmaconnect Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://unpkg.com/cropperjs/dist/cropper.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/cropperjs/dist/cropper.min.js"></script>
</head>

<body class="bg-gray-100">

    <div class="flex">

        {{-- SIDEBAR --}}
        @include('admin.components.sidebar')

        {{-- MAIN --}}
        <div id="mainContent" class="flex-1 min-h-screen transition-all duration-300 ml-0 md:ml-64">

            <div class="p-4">

                {{-- HEADER --}}
                @include('admin.components.header')

                {{-- PAGE CONTENT --}}
                @yield('content')

            </div>
        </div>

    </div>

    {{-- GLOBAL SCRIPT --}}
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
                // COLLAPSE
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');

                main.classList.remove('md:ml-64');
                main.classList.add('md:ml-20');

                texts.forEach(t => t.classList.add('hidden'));

            } else {
                // EXPAND
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');

                main.classList.remove('md:ml-20');
                main.classList.add('md:ml-64');

                texts.forEach(t => t.classList.remove('hidden'));
            }
        }
    </script>

</body>

</html>
