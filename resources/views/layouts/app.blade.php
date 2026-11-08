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
            <div class="flex items-center justify-between py-4">

                <!-- Left: Logo -->
                <a class="flex items-center gap-3 group flex-shrink-0" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo/bangla_puzzle_logo_4x.png') }}" 
                         alt="Bangla Puzzle" 
                         onerror="this.src='{{ asset('images/logo/bangla_puzzle_logo.png') }}'"
                         class="h-10 w-auto object-contain">
                    <div class="flex flex-col">
                        <span class="text-lg font-bold leading-tight tracking-tight">
                            <span class="text-[#8F1E5F]">Bangla</span><span class="text-[#115C8F]">Puzzle</span>
                        </span>
                        <span class="text-[9px] font-semibold text-dark-4 tracking-wider uppercase">
                            E-Commerce &bull; Limited
                        </span>
                    </div>
                </a>

                <!-- Right: Admin Portal Link -->
                <div class="flex items-center gap-4">
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
                <nav class="flex items-center gap-6 py-3 text-xs font-semibold text-dark overflow-x-auto no-scrollbar">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue font-bold' : 'hover:text-blue' }} transition whitespace-nowrap">
                        Home
                    </a>
                    @if(isset($navCategories))
                        @php
                            $activeCategoryParam = request()->route('category');
                            $activeCategorySlug = is_object($activeCategoryParam) ? $activeCategoryParam->slug : $activeCategoryParam;
                        @endphp
                        @foreach($navCategories as $navCat)
                            <a href="{{ route('storefront.category', $navCat->slug) }}" 
                               class="{{ ($activeCategorySlug === $navCat->slug) ? 'text-blue font-bold' : 'hover:text-blue' }} transition whitespace-nowrap">
                                {{ $navCat->name }}
                            </a>
                        @endforeach
                    @endif
                    <a href="{{ route('home') }}#products-section" class="hover:text-blue transition whitespace-nowrap text-dark-4">
                        All Products
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
                <p>Developed by <span class="font-semibold text-dark">Kazi Omar Faruk</span></p>
            </div>
        </div>
    </footer>

    @stack('scripts')

</body>
</html>
