@extends('layouts.app')

@section('title', 'Bangla Puzzle Limited — Storefront')

@section('content')
    <!-- ==================== HERO SECTION START ==================== -->
    <section class="overflow-hidden pb-10 lg:pb-12 xl:pb-15 pt-8 bg-[#E5EAF4]">
        <div class="max-w-[1170px] w-full mx-auto px-4 sm:px-8 xl:px-0">
            <div class="flex flex-wrap gap-5">
                
                @php
                    $hero = $heroAndDeals['hero'] ?? null;
                    $deals = $heroAndDeals['deals'] ?? collect();
                @endphp

                <!-- Hero Left Featured Banner -->
                <div class="xl:max-w-[757px] w-full">
                    <div class="relative z-1 rounded-[10px] bg-white overflow-hidden p-6 sm:p-10 flex items-center flex-col-reverse sm:flex-row justify-between min-h-[440px]">
                        <img src="{{ asset('images/hero/hero-bg.png') }}" alt="hero bg" class="absolute right-0 bottom-0 -z-1 w-[534px] pointer-events-none">
                        
                        <div class="max-w-[394px] py-4">
                            @if($hero && $hero->discount_percentage)
                                <div class="flex items-center gap-4 mb-6">
                                    <span class="font-bold text-4xl text-blue">{{ $hero->discount_percentage }}%</span>
                                    <span class="text-dark text-sm leading-tight font-medium">Sale<br/>Off</span>
                                </div>
                            @else
                                <div class="flex items-center gap-4 mb-6">
                                    <span class="font-bold text-4xl text-blue">Featured</span>
                                    <span class="text-dark text-sm leading-tight font-medium">Top<br/>Pick</span>
                                </div>
                            @endif

                            <h1 class="font-semibold text-dark text-2xl sm:text-3xl mb-3 leading-snug">
                                <a href="{{ $hero ? route('storefront.product', $hero->slug) : '#' }}">
                                    {{ $hero ? $hero->name : 'Premium Quality Headphone & Accessories' }}
                                </a>
                            </h1>

                            <p class="text-xs text-dark-3 mb-8 leading-relaxed line-clamp-2">
                                {{ $hero ? ($hero->description ?: 'Discover next-level performance and craftsmanship engineered for daily life.') : 'Explore our high performance devices with verified warranties and official support.' }}
                            </p>

                            @if($hero)
                                <a href="{{ route('storefront.product', $hero->slug) }}" class="inline-flex font-medium text-white text-xs rounded-md bg-dark py-3 px-9 hover:bg-blue transition">
                                    Shop Now
                                </a>
                            @else
                                <a href="#products-section" class="inline-flex font-medium text-white text-xs rounded-md bg-dark py-3 px-9 hover:bg-blue transition">
                                    Explore Catalog
                                </a>
                            @endif
                        </div>

                        <div class="w-[260px] sm:w-[320px] flex items-center justify-center">
                            @if($hero && $hero->image)
                                <img src="{{ upload_url($hero->image) }}" 
                                     alt="{{ $hero->name }}" 
                                     onerror="this.src='{{ asset('images/hero/hero-01.png') }}'"
                                     class="max-h-[280px] w-auto object-contain">
                            @else
                                <img src="{{ asset('images/hero/hero-01.png') }}" alt="Featured Product" class="w-[280px] object-contain">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Hero Right Deals Cards -->
                <div class="xl:max-w-[393px] w-full flex flex-col sm:flex-row xl:flex-col gap-5">
                    @forelse($deals as $deal)
                        <div class="w-full relative rounded-[10px] bg-white p-6 flex items-center justify-between">
                            <div>
                                <h2 class="max-w-[160px] font-semibold text-dark text-base mb-6 leading-snug line-clamp-2">
                                    <a href="{{ route('storefront.product', $deal->slug) }}" class="hover:text-blue transition">
                                        {{ $deal->name }}
                                    </a>
                                </h2>
                                <div>
                                    <p class="font-medium text-dark-4 text-[10px] mb-1 uppercase tracking-wider">LIMITED TIME OFFER</p>
                                    <span class="flex items-center gap-2">
                                        <span class="font-bold text-base text-red">${{ number_format($deal->new_price, 2) }}</span>
                                        @if($deal->old_price && $deal->old_price > $deal->new_price)
                                            <span class="font-medium text-xs text-dark-4 line-through">${{ number_format($deal->old_price, 2) }}</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="w-[110px] h-[110px] flex items-center justify-center flex-shrink-0">
                                @if($deal->image)
                                    <img src="{{ upload_url($deal->image) }}" 
                                         alt="{{ $deal->name }}" 
                                         onerror="this.src='{{ asset('images/hero/hero-02.png') }}'"
                                         class="max-h-full max-w-full object-contain">
                                @else
                                    <img src="{{ asset('images/hero/hero-02.png') }}" alt="{{ $deal->name }}" class="w-[110px] object-contain">
                                @endif
                            </div>
                        </div>
                    @empty
                        <!-- Fallback Card 1 -->
                        <div class="w-full relative rounded-[10px] bg-white p-6 flex items-center justify-between">
                            <div>
                                <h2 class="max-w-[153px] font-semibold text-dark text-base mb-6 leading-snug">
                                    iPhone 14 Plus & 14 Pro Max
                                </h2>
                                <div>
                                    <p class="font-medium text-dark-4 text-[10px] mb-1 uppercase tracking-wider">LIMITED TIME OFFER</p>
                                    <span class="flex items-center gap-2">
                                        <span class="font-bold text-base text-red">$699.00</span>
                                        <span class="font-medium text-xs text-dark-4 line-through">$999.00</span>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <img src="{{ asset('images/hero/hero-02.png') }}" alt="iPhone" class="w-[110px] object-contain">
                            </div>
                        </div>

                        <!-- Fallback Card 2 -->
                        <div class="w-full relative rounded-[10px] bg-white p-6 flex items-center justify-between">
                            <div>
                                <h2 class="max-w-[153px] font-semibold text-dark text-base mb-6 leading-snug">
                                    Wireless Headphone
                                </h2>
                                <div>
                                    <p class="font-medium text-dark-4 text-[10px] mb-1 uppercase tracking-wider">LIMITED TIME OFFER</p>
                                    <span class="flex items-center gap-2">
                                        <span class="font-bold text-base text-red">$129.00</span>
                                        <span class="font-medium text-xs text-dark-4 line-through">$189.00</span>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <img src="{{ asset('images/hero/hero-01.png') }}" alt="Headphone" class="w-[110px] object-contain">
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

        <!-- Hero Highlights -->
        <div class="max-w-[1060px] w-full mx-auto px-4 sm:px-8 xl:px-0 pt-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/icons/icon-01.svg') }}" alt="Shipping" width="40" height="41">
                    <div>
                        <h3 class="font-semibold text-sm text-dark">Free Shipping</h3>
                        <p class="text-xs text-dark-4">For verified orders</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/icons/icon-02.svg') }}" alt="Returns" width="40" height="41">
                    <div>
                        <h3 class="font-semibold text-sm text-dark">Easy Returns</h3>
                        <p class="text-xs text-dark-4">7 days warranty policy</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/icons/icon-03.svg') }}" alt="Security" width="40" height="41">
                    <div>
                        <h3 class="font-semibold text-sm text-dark">100% Secure</h3>
                        <p class="text-xs text-dark-4">Protected checkout</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/icons/icon-04.svg') }}" alt="Support" width="40" height="41">
                    <div>
                        <h3 class="font-semibold text-sm text-dark">Dedicated Support</h3>
                        <p class="text-xs text-dark-4">Official customer care</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== HERO SECTION END ==================== -->

    <!-- ==================== BROWSE BY CATEGORY START ==================== -->
    <section id="categories-section" class="pt-16 pb-6">
        <div class="max-w-[1170px] w-full mx-auto px-4 sm:px-8 xl:px-0">
            <div class="mb-7 flex items-center justify-between">
                <div>
                    <span class="flex items-center gap-2 font-medium text-dark text-xs mb-1">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                            <path d="M3.94 13.45C2.65 12.16 2.01 11.52 1.77 10.68C1.53 9.84 1.73 8.96 2.14 7.18L2.38 6.16C2.72 4.67 2.9 3.92 3.41 3.41C3.92 2.9 4.67 2.72 6.16 2.38L7.18 2.14C8.96 1.73 9.84 1.53 10.68 1.77C11.52 2.01 12.16 2.65 13.45 3.94L14.97 5.47C17.21 7.71 18.33 8.83 18.33 10.22C18.33 11.61 17.21 12.73 14.97 14.97C12.73 17.21 11.61 18.33 10.22 18.33C8.83 18.33 7.71 17.21 5.46 14.97L3.94 13.45Z" stroke="#3C50E0" stroke-width="1.5"/>
                            <circle cx="7.17" cy="7.4" r="1.67" stroke="#3C50E0" stroke-width="1.5"/>
                            <path d="M9.62 15.42L15.43 9.6" stroke="#3C50E0" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        Categories
                    </span>
                    <h2 class="font-bold text-2xl text-dark">Browse by Category</h2>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-5">
                @forelse($featuredCategories as $index => $category)
                    <a href="{{ route('storefront.category', $category->slug) }}" class="group flex flex-col items-center p-3 rounded-xl hover:bg-gray-1 transition border border-transparent hover:border-gray-3">
                        <div class="w-[110px] h-[110px] bg-[#F2F3F8] rounded-full flex items-center justify-center mb-3 group-hover:bg-blue/10 transition overflow-hidden">
                            @if($category->image)
                                <img src="{{ upload_url($category->image) }}" 
                                     alt="{{ $category->name }}" 
                                     onerror="this.src='{{ asset('images/categories/categories-0' . (($index % 7) + 1) . '.png') }}'"
                                     class="w-[65px] h-[65px] object-contain">
                            @else
                                <img src="{{ asset('images/categories/categories-0' . (($index % 7) + 1) . '.png') }}" 
                                     alt="{{ $category->name }}" 
                                     class="w-[65px] h-[65px] object-contain">
                            @endif
                        </div>
                        <h3 class="font-semibold text-xs text-center text-dark group-hover:text-blue transition mb-1">
                            {{ $category->name }}
                        </h3>
                        <span class="text-[11px] text-dark-4">
                            {{ $category->products_count ?? 0 }} products
                        </span>
                    </a>
                @empty
                    <div class="col-span-full py-8 text-center text-dark-4 text-xs font-medium">
                        No active categories available.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- ==================== BROWSE BY CATEGORY END ==================== -->

    <!-- ==================== LATEST PRODUCTS START ==================== -->
    <section id="products-section" class="pt-10 pb-16">
        <div class="max-w-[1170px] w-full mx-auto px-4 sm:px-8 xl:px-0">
            <div class="mb-7 flex items-center justify-between">
                <div>
                    <span class="flex items-center gap-2 font-medium text-dark text-xs mb-1">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                            <path d="M3.12 15.46C4.12 16.67 5.98 16.67 9.7 16.67H10.3C14.02 16.67 15.88 16.67 16.88 15.46" stroke="#3C50E0" stroke-width="1.5"/>
                            <path d="M7.64 6.67C7.99 7.64 8.91 8.33 10 8.33C11.09 8.33 12.01 7.64 12.36 6.67" stroke="#3C50E0" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        Featured Products
                    </span>
                    <h2 class="font-bold text-2xl text-dark">Latest Products</h2>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
                @forelse($latestProducts as $product)
                    <div class="group flex flex-col justify-between">
                        <div>
                            <div class="relative overflow-hidden flex items-center justify-center rounded-lg bg-[#F6F7FB] min-h-[260px] p-6 mb-4">
                                @if($product->discount_percentage)
                                    <span class="absolute top-3 left-3 px-2 py-0.5 rounded-full bg-blue text-white text-[10px] font-bold z-10 shadow-xs">
                                        -{{ $product->discount_percentage }}%
                                    </span>
                                @endif

                                @if($product->image)
                                    <img src="{{ upload_url($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         onerror="this.src='{{ asset('images/products/product-1-bg-1.png') }}'"
                                         class="w-[180px] h-[180px] object-contain group-hover:scale-105 transition duration-300">
                                @else
                                    <img src="{{ asset('images/products/product-1-bg-1.png') }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-[180px] h-[180px] object-contain group-hover:scale-105 transition duration-300">
                                @endif

                                <div class="absolute left-0 bottom-0 translate-y-full w-full flex items-center justify-center gap-2 pb-4 group-hover:translate-y-0 transition duration-200">
                                    <a href="{{ route('storefront.product', $product->slug) }}" class="px-4 py-2 bg-blue text-white rounded text-xs font-semibold hover:bg-blue-dark shadow-xs transition">
                                        View Details
                                    </a>
                                </div>
                            </div>

                            @if($product->subcategory)
                                <span class="text-[11px] font-medium text-dark-4 block mb-1">
                                    {{ $product->subcategory->name }}
                                </span>
                            @endif

                            <h3 class="font-medium text-sm text-dark hover:text-blue mb-2 line-clamp-2">
                                <a href="{{ route('storefront.product', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h3>
                        </div>

                        <div class="pt-2">
                            <span class="flex items-center gap-2 font-bold text-sm">
                                <span class="text-dark">${{ number_format($product->new_price, 2) }}</span>
                                @if($product->old_price && $product->old_price > $product->new_price)
                                    <span class="text-dark-4 line-through font-normal text-xs">${{ number_format($product->old_price, 2) }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-dark-4 text-xs font-medium">
                        No products found in the catalog.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- ==================== LATEST PRODUCTS END ==================== -->
@endsection
