<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    @vite('resources/css/app.css')
    @yield('styles')
</head>

<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-blue-600 to-blue-500 text-white p-6 shadow-lg">
            <h2 class="text-2xl font-bold mb-8 tracking-wide">Admin Panel</h2>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.courses.index') }}"
                        class="block p-3 rounded-lg hover:bg-blue-400 transition-colors duration-200 {{ request()->routeIs('admin.courses.*') ? 'bg-blue-400' : '' }}">
                        <span class="text-sm font-medium">Courses</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}"
                        class="block p-3 rounded-lg hover:bg-blue-400 transition-colors duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-blue-400' : '' }}">
                        <span class="text-sm font-medium">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.course-details.index') }}"
                        class="block p-3 rounded-lg hover:bg-blue-400 transition-colors duration-200 {{ request()->routeIs('admin.course-details.*') ? 'bg-blue-400' : '' }}">
                        <span class="text-sm font-medium">Course Details</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        class="block p-3 rounded-lg hover:bg-blue-400 transition-colors duration-200">
                        <span class="text-sm font-medium">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            @if (session('success'))
            <div class="bg-green-50 text-green-600 p-4 rounded-lg mb-6 shadow-sm">
                {{ session('success') }}
            </div>
            @endif
            @yield('content')
        </div>
    </div>
    @vite('resources/js/app.js')
    @yield('scripts')
</body>

</html>