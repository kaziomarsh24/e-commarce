@extends('layouts.app')

@section('title', ($subcategory ? $subcategory->name . ' — ' : '') . $category->name . ' — Bangla Puzzle Limited')

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-gray-1 py-8 border-b border-gray-3">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-dark">
                    {{ $subcategory ? $subcategory->name : $category->name }}
                </h1>
                <p class="text-xs text-dark-4 mt-1">
                    {{ $subcategory ? 'Showing products under ' . $subcategory->name . ' (' . $category->name . ')' : 'Explore our collection of ' . $category->name }}
                </p>
            </div>
            <div class="text-xs text-dark-4 flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-blue transition">Home</a>
                <span>/</span>
                <a href="{{ route('storefront.category', $category->slug) }}" class="{{ !$subcategory ? 'text-dark font-medium' : 'hover:text-blue transition' }}">
                    {{ $category->name }}
                </a>
                @if($subcategory)
                    <span>/</span>
                    <span class="text-dark font-medium">{{ $subcategory->name }}</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Category Products Grid -->
    <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 py-10 w-full space-y-8">
        
        <!-- Subcategory Filter Pills -->
        @if($subcategories->isNotEmpty())
            <div class="flex items-center gap-2 pb-4 border-b border-gray-3 overflow-x-auto no-scrollbar">
                <span class="text-xs font-bold text-dark uppercase tracking-wider whitespace-nowrap mr-2">Filter:</span>
                
                <a href="{{ route('storefront.category', $category->slug) }}" 
                   class="px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap transition {{ !$subcategory ? 'bg-blue text-white shadow-xs' : 'bg-gray-1 text-dark hover:bg-gray-2' }}">
                    All
                </a>

                @foreach($subcategories as $sub)
                    <a href="{{ route('storefront.subcategory', [$category->slug, $sub->slug]) }}" 
                       class="px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap transition {{ ($subcategory && $subcategory->id === $sub->id) ? 'bg-blue text-white shadow-xs' : 'bg-gray-1 text-dark hover:bg-gray-2' }}">
                        {{ $sub->name }} ({{ $sub->products_count }})
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
            @forelse($products as $product)
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
                <div class="col-span-full py-16 text-center">
                    <p class="text-dark-4 text-sm font-medium mb-4">No products found in this category or subcategory.</p>
                    <a href="{{ route('home') }}" class="px-5 py-2.5 rounded-lg bg-blue text-white text-xs font-semibold hover:bg-blue-dark transition">
                        &larr; Back to Storefront
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="pt-8 border-t border-gray-3 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif

    </div>
@endsection
