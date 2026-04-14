<!DOCTYPE html>
<html>

<head>
    <title>Farmaconnect Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white min-h-screen p-5">
        <h2 class="text-xl font-bold mb-6">Admin</h2>

        <ul>
            <li><a href="/admin" class="block py-2">Dashboard</a></li>
            <li><a href="/admin/products" class="block py-2">Products</a></li>
            <li><a href="/admin/orders" class="block py-2">Orders</a></li>
            <li><a href="/admin/prescriptions" class="block py-2">Prescriptions</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="flex-1 p-6">
        @yield('content')
    </div>

</body>

</html>
