
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Matrif Fruit POS - Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-800">

    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar: resources/views/components/admin/sidebar.blade.php --}}
        <x-admin.sidebar />

        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Topbar: resources/views/components/admin/topbar.blade.php --}}
            <x-admin.topbar />

            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>
