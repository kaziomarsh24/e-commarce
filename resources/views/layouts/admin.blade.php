<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Portal') — Bangla Puzzle E-Commerce</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: {
                            DEFAULT: '#1C274C',
                            2: '#495270',
                            3: '#606882',
                            4: '#8D93A5',
                        },
                        blue: {
                            DEFAULT: '#3C50E0',
                            dark: '#1C3FB7',
                        },
                        gray: {
                            1: '#F9FAFB',
                            2: '#F3F4F6',
                            3: '#E5E7EB',
                        },
                        green: '#22AD5C',
                        red: '#F23030',
                    },
                    fontFamily: {
                        sans: ['"Euclid Circular A"', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @font-face {
            font-family: "Euclid Circular A";
            src: url("{{ asset('fonts/EuclidCircularA-Regular.woff2') }}") format("woff2");
            font-weight: 400;
        }

        @font-face {
            font-family: "Euclid Circular A";
            src: url("{{ asset('fonts/EuclidCircularA-SemiBold.woff2') }}") format("woff2");
            font-weight: 600;
        }

        @font-face {
            font-family: "Euclid Circular A";
            src: url("{{ asset('fonts/EuclidCircularA-Bold.woff2') }}") format("woff2");
            font-weight: 700;
        }

        body {
            font-family: "Euclid Circular A", system-ui, sans-serif;
            color: #606882;
        }
    </style>
</head>

<body class="bg-gray-1 min-h-screen flex flex-col">

    <!-- Admin Topbar Navigation -->
    <header class="bg-white border-b border-gray-3 sticky top-0 z-40 shadow-xs">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">
            <div class="flex items-center justify-between h-16 gap-6">

                <!-- Brand / Logo -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 flex-shrink-0">
                        <img src="{{ asset('images/logo/bangla_puzzle_logo.png') }}" alt="Bangla Puzzle"
                            class="h-8 w-auto object-contain">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold leading-none tracking-tight">
                                <span class="text-[#8F1E5F]">Bangla</span><span class="text-[#115C8F]">Puzzle</span>
                            </span>
                            <span class="text-[8px] font-semibold text-dark-4 uppercase tracking-wider">Admin
                                Portal</span>
                        </div>
                    </a>
                </div>

                <!-- Admin Navigation Menu -->
                <nav class="hidden md:flex items-center gap-6 text-xs font-semibold text-dark-3">
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ request()->routeIs('admin.dashboard') ? 'text-blue border-b-2 border-blue pb-1' : 'hover:text-dark transition pb-1' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                        class="{{ request()->routeIs('admin.categories.*') ? 'text-blue border-b-2 border-blue pb-1' : 'hover:text-dark transition pb-1' }}">
                        Categories
                    </a>
                    <a href="{{ route('admin.subcategories.index') }}"
                        class="{{ request()->routeIs('admin.subcategories.*') ? 'text-blue border-b-2 border-blue pb-1' : 'hover:text-dark transition pb-1' }}">
                        Subcategories
                    </a>
                    <a href="{{ route('admin.products.index') }}"
                        class="{{ request()->routeIs('admin.products.*') ? 'text-blue border-b-2 border-blue pb-1' : 'hover:text-dark transition pb-1' }}">
                        Products
                    </a>
                </nav>

                <!-- Storefront Link & User Info -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank"
                        class="text-xs text-dark-3 hover:text-dark transition flex items-center gap-1 font-medium">
                        <span>View Store</span>
                        <span>&nearr;</span>
                    </a>
                    <div class="h-4 w-px bg-gray-3"></div>
                    <div class="flex items-center gap-2">
                        <div
                            class="w-8 h-8 rounded-full bg-blue/10 text-blue font-bold text-xs flex items-center justify-center">
                            A
                        </div>
                        <span class="text-xs font-semibold text-dark hidden sm:inline">Admin</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline ml-1">
                            @csrf
                            <button type="submit" class="text-xs text-red hover:underline font-medium transition" title="Logout">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="flex-grow max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 py-8 w-full space-y-6">

        <!-- Flash Messages (Success / Error Notification) -->
        @if(session('success'))
        <div
            class="p-4 rounded-lg bg-green/10 border border-green/20 text-green text-xs font-semibold flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green hover:opacity-75 font-bold">&times;</button>
        </div>
        @endif

        @if(session('error'))
        <div
            class="p-4 rounded-lg bg-red/10 border border-red/20 text-red text-xs font-semibold flex items-center justify-between">
            <span>{{ session('error') }}</span>
            <button onclick="this.parentElement.remove()" class="text-red hover:opacity-75 font-bold">&times;</button>
        </div>
        @endif

        @if($errors->any())
        <div class="p-4 rounded-lg bg-red/10 border border-red/20 text-red text-xs space-y-1">
            <p class="font-bold">Please check the form for errors:</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Dynamic Page Content -->
        @yield('content')

    </main>

    <!-- Admin Footer -->
    <footer class="bg-white border-t border-gray-3 py-6 mt-12 text-center text-xs text-dark-4">
        <p>&copy; {{ date('Y') }} Bangla Puzzle Limited &bull; Developed by <span class="font-semibold text-dark">Kazi
                Omar Faruk</span></p>
    </footer>

    <!-- Page Specific Scripts -->
    @stack('scripts')

</body>

</html>
