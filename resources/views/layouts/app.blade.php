<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bangla Puzzle E-Commerce')</title>
    <meta name="description" content="@yield('meta_description', 'Modern e-commerce platform by Bangla Puzzle Limited.')">

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
                            5: '#BBBEC9',
                        },
                        brand: {
                            purple: '#8F1E5F',
                            blue: '#115C8F',
                        },
                        blue: {
                            DEFAULT: '#3C50E0',
                            dark: '#1C3FB7',
                            light: '#5475E5',
                        },
                        gray: {
                            1: '#F9FAFB',
                            2: '#F3F4F6',
                            3: '#E5E7EB',
                            4: '#D1D5DB',
                        },
                        red: '#F23030',
                        green: '#22AD5C',
                        orange: '#F27430',
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
<body class="bg-white min-h-screen flex flex-col">

    <!-- ==================== STOREFRONT HEADER ==================== -->
    <header class="w-full bg-white border-b border-gray-3 sticky top-0 z-50 shadow-xs">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">

            <!-- Top Bar -->
            <div class="flex flex-col lg:flex-row gap-5 items-end lg:items-center xl:justify-between py-5">

                <!-- Left: Logo & Search -->
                <div class="xl:w-auto flex-col sm:flex-row w-full flex sm:justify-between sm:items-center gap-5 sm:gap-10">
                    <a class="flex items-center gap-3 group flex-shrink-0" href="{{ route('home') }}">
                        <img src="{{ asset('images/logo/bangla_puzzle_logo_4x.png') }}" alt="Bangla Puzzle" class="h-10 w-auto object-contain">
                        <div class="flex flex-col">
                            <span class="text-lg font-bold leading-tight tracking-tight">
                                <span class="text-[#8F1E5F]">Bangla</span><span class="text-[#115C8F]">Puzzle</span>
                            </span>
                            <span class="text-[9px] font-semibold text-dark-4 tracking-wider uppercase">
                                E-Commerce &bull; Limited
                            </span>
                        </div>
                    </a>

                    <!-- Search Input -->
                    <div class="max-w-[420px] w-full">
                        <form action="{{ route('home') }}" method="GET">
                            <div class="flex items-center">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="I am shopping for..." class="w-full bg-gray-1 border border-gray-3 rounded-l-[5px] py-2.5 px-4 text-xs text-dark placeholder:text-dark-4 focus:outline-none focus:border-blue">
                                <button type="submit" class="bg-blue hover:bg-blue-dark text-white text-xs px-5 py-3 rounded-r-[5px] transition flex items-center justify-center">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right: Support & Admin Portal Link -->
                <div class="flex items-center gap-6">
                    <div class="hidden sm:flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-1 border border-gray-3 flex items-center justify-center text-blue">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></svg>
                        </div>
                        <div>
                            <span class="block text-[10px] text-dark-4 uppercase tracking-wider font-semibold">24/7 SUPPORT</span>
                            <span class="text-xs font-bold text-dark">+880 1894-438179</span>
                        </div>
                    </div>

                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg bg-dark hover:bg-blue text-white text-xs font-semibold shadow-xs transition flex items-center gap-2">
                        <span>Admin Portal</span>
                        <span>&rarr;</span>
                    </a>
                </div>

            </div>
        </div>

        <!-- Sub Navbar -->
        <div class="border-t border-gray-3 bg-white">
            <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0">
                <nav class="flex items-center gap-8 py-3 text-xs font-semibold text-dark">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue' : 'hover:text-blue' }} transition">
                        Home
                    </a>
                    <a href="{{ route('home') }}#products-section" class="hover:text-blue transition">
                        Products by Subcategory
                    </a>
                    <a href="{{ route('home') }}#categories-section" class="hover:text-blue transition">
                        Categories
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Flash Message Container -->
    @if(session('success'))
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 mt-4 w-full">
            <div class="p-4 rounded-lg bg-green/10 border border-green/20 text-green text-xs font-semibold">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Dynamic Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ==================== STOREFRONT FOOTER ==================== -->
    <footer class="border-t border-gray-3 pt-12 pb-8 bg-white mt-16">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 space-y-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 pb-8 border-b border-gray-3">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo/bangla_puzzle_logo_4x.png') }}" alt="Bangla Puzzle" class="h-9 w-auto object-contain">
                    <div>
                        <span class="text-base font-bold text-dark block leading-tight">Bangla Puzzle Limited</span>
                        <span class="text-xs text-dark-4">Reliable software & e-commerce solutions</span>
                    </div>
                </div>

                <div class="flex items-center gap-6 text-xs font-medium text-dark-3">
                    <a href="{{ route('home') }}" class="hover:text-blue">Storefront</a>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue">Admin Console</a>
                    <a href="{{ route('admin.products.index') }}" class="hover:text-blue">Manage Products</a>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-dark-4">
                <p>&copy; {{ date('Y') }} Bangla Puzzle Limited. All rights reserved.</p>
                <p>Crafted by <span class="font-semibold text-dark">Kazi Omar Faruk</span></p>
            </div>
        </div>
    </footer>

    @stack('scripts')

</body>
</html>
