@extends('layouts.app')

@section('title', $product->name . ' — Bangla Puzzle Limited')
@section('meta_description', Str::limit(strip_tags($product->description), 150))

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-gray-1 py-8 border-b border-gray-3">
        <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h1 class="text-2xl font-bold text-dark">Product Details</h1>
            <div class="text-xs text-dark-4 flex items-center gap-2 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-blue transition">Home</a>
                <span>/</span>
                @if($product->category)
                    <a href="{{ route('storefront.category', $product->category->slug) }}" class="hover:text-blue transition">
                        {{ $product->category->name }}
                    </a>
                    <span>/</span>
                @endif
                @if($product->subcategory)
                    <a href="{{ route('storefront.subcategory', [$product->category->slug, $product->subcategory->slug]) }}" class="hover:text-blue transition">
                        {{ $product->subcategory->name }}
                    </a>
                    <span>/</span>
                @endif
                <span class="text-dark font-medium truncate max-w-[200px]">{{ $product->name }}</span>
            </div>
        </div>
    </div>

    <!-- Product Details Content -->
    <div class="max-w-[1170px] mx-auto px-4 sm:px-8 xl:px-0 py-12 w-full space-y-16">
        
        <div class="flex flex-col lg:flex-row gap-12 xl:gap-16">
            
            <!-- Left: Product Media Gallery -->
            <div class="lg:max-w-[500px] w-full space-y-4">
                @php
                    $primaryImageUrl = $product->image ? upload_url($product->image) : asset('images/products/product-1-bg-1.png');
                    $gallery = is_array($product->gallery_images) ? $product->gallery_images : [];
                @endphp

                <!-- Main Preview Box -->
                <div class="rounded-xl bg-[#F6F7FB] p-8 flex items-center justify-center min-h-[420px] max-h-[460px] border border-gray-3 relative overflow-hidden">
                    @if($product->discount_percentage)
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full bg-blue text-white text-xs font-bold shadow-xs">
                            -{{ $product->discount_percentage }}% OFF
                        </span>
                    @endif

                    <img id="main-preview" 
                         src="{{ $primaryImageUrl }}" 
                         alt="{{ $product->name }}" 
                         onerror="this.src='{{ asset('images/products/product-1-bg-1.png') }}'"
                         class="max-h-[340px] max-w-full object-contain transition-all duration-300">
                </div>

                <!-- Thumbnails -->
                @if(count($gallery) > 0 || $product->image)
                    <div class="flex items-center gap-3 overflow-x-auto pb-2 no-scrollbar">
                        <!-- Primary Image Thumb -->
                        <button type="button" 
                                onclick="switchPreview('{{ $primaryImageUrl }}', this)" 
                                class="thumb-btn w-20 h-20 rounded-xl bg-[#F6F7FB] border-2 border-blue p-2 flex items-center justify-center transition flex-shrink-0">
                            <img src="{{ $primaryImageUrl }}" alt="Primary" class="h-full object-contain pointer-events-none">
                        </button>

                        <!-- Gallery Thumbs -->
                        @foreach($gallery as $img)
                            @php
                                $thumbUrl = upload_url($img, variant: 'thumb') ?? upload_url($img);
                                $fullUrl  = upload_url($img);
                            @endphp
                            <button type="button" 
                                    onclick="switchPreview('{{ $fullUrl }}', this)" 
                                    class="thumb-btn w-20 h-20 rounded-xl bg-[#F6F7FB] border border-gray-3 p-2 flex items-center justify-center hover:border-blue transition flex-shrink-0">
                                <img src="{{ $thumbUrl }}" alt="Gallery thumbnail" class="h-full object-contain pointer-events-none">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right: Product Info -->
            <div class="flex-1 space-y-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        @if($product->category)
                            <a href="{{ route('storefront.category', $product->category->slug) }}" class="text-xs font-semibold text-blue bg-blue/10 px-2.5 py-1 rounded-md hover:bg-blue/20 transition">
                                {{ $product->category->name }}
                            </a>
                        @endif
                        @if($product->subcategory)
                            <a href="{{ route('storefront.subcategory', [$product->category->slug, $product->subcategory->slug]) }}" class="text-xs font-semibold text-dark-3 bg-gray-2 px-2.5 py-1 rounded-md hover:bg-gray-3 transition">
                                {{ $product->subcategory->name }}
                            </a>
                        @endif
                    </div>

                    <h2 class="font-bold text-2xl sm:text-3xl text-dark leading-snug">
                        {{ $product->name }}
                    </h2>

                    <div class="flex items-center gap-2 mt-3">
                        <span class="text-orange text-sm">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                        <span class="text-xs text-dark-4">(Official Authentic Product)</span>
                        <span class="text-xs font-semibold text-green bg-green/10 px-2 py-0.5 rounded ml-2">In Stock</span>
                    </div>

                    <div class="flex items-baseline gap-3 my-6 pt-4 border-t border-gray-3">
                        <span class="text-3xl font-extrabold text-dark">${{ number_format($product->new_price, 2) }}</span>
                        @if($product->old_price && $product->old_price > $product->new_price)
                            <span class="text-lg text-dark-4 line-through">${{ number_format($product->old_price, 2) }}</span>
                            <span class="text-xs font-bold text-red bg-red/10 px-2 py-1 rounded">
                                Save ${{ number_format($product->old_price - $product->new_price, 2) }}
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="prose max-w-none text-xs sm:text-sm text-dark-3 leading-relaxed space-y-4">
                        <p>{!! nl2br(e($product->description)) !!}</p>
                    </div>
                </div>

                <!-- Purchase Action Box -->
                <div class="pt-6 border-t border-gray-3 space-y-4">
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center border border-gray-3 rounded-lg overflow-hidden bg-white">
                            <button type="button" onclick="decrementQty()" class="px-3 py-2 text-dark hover:bg-gray-2 font-bold">-</button>
                            <input type="text" id="cart-quantity" value="1" readonly class="w-12 text-center text-xs font-semibold text-dark focus:outline-none">
                            <button type="button" onclick="incrementQty()" class="px-3 py-2 text-dark hover:bg-gray-2 font-bold">+</button>
                        </div>

                        <button type="button" class="px-8 py-3 bg-blue text-white rounded-lg text-xs font-semibold hover:bg-blue-dark shadow-sm transition flex items-center gap-2">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" class="stroke-current">
                                <path d="M3 3h2l2.5 10h9.5l2-7H6.5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="8" cy="16.5" r="1.5" fill="currentColor"/>
                                <circle cx="16" cy="16.5" r="1.5" fill="currentColor"/>
                            </svg>
                            <span>Add to Cart</span>
                        </button>

                        <a href="{{ route('home') }}" class="px-5 py-3 border border-gray-3 rounded-lg text-xs font-semibold text-dark hover:bg-gray-1 transition">
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Specifications & Metadata -->
                <div class="pt-6 border-t border-gray-3 grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-dark-4 block uppercase tracking-wider text-[10px]">CATEGORY</span>
                        <span class="font-semibold text-dark">{{ $product->category?->name ?? 'Unassigned' }}</span>
                    </div>
                    <div>
                        <span class="text-dark-4 block uppercase tracking-wider text-[10px]">SUBCATEGORY</span>
                        <span class="font-semibold text-dark">{{ $product->subcategory?->name ?? 'None' }}</span>
                    </div>
                    <div>
                        <span class="text-dark-4 block uppercase tracking-wider text-[10px]">WARRANTY</span>
                        <span class="font-semibold text-dark">Official 1 Year Warranty</span>
                    </div>
                    <div>
                        <span class="text-dark-4 block uppercase tracking-wider text-[10px]">SHIPPING</span>
                        <span class="font-semibold text-dark">Fast Nationwide Delivery</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- ==================== RELATED PRODUCTS START ==================== -->
        @if($related->isNotEmpty())
            <div class="pt-12 border-t border-gray-3">
                <div class="mb-8">
                    <span class="text-xs font-medium text-blue uppercase tracking-wider">Related Items</span>
                    <h2 class="text-2xl font-bold text-dark mt-1">You May Also Like</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">
                    @foreach($related as $relProduct)
                        <div class="group flex flex-col justify-between">
                            <div>
                                <div class="relative overflow-hidden flex items-center justify-center rounded-lg bg-[#F6F7FB] min-h-[240px] p-6 mb-4">
                                    @if($relProduct->discount_percentage)
                                        <span class="absolute top-3 left-3 px-2 py-0.5 rounded-full bg-blue text-white text-[10px] font-bold z-10 shadow-xs">
                                            -{{ $relProduct->discount_percentage }}%
                                        </span>
                                    @endif

                                    @if($relProduct->image)
                                        <img src="{{ upload_url($relProduct->image) }}" 
                                             alt="{{ $relProduct->name }}" 
                                             onerror="this.src='{{ asset('images/products/product-1-bg-1.png') }}'"
                                             class="w-[160px] h-[160px] object-contain group-hover:scale-105 transition duration-300">
                                    @else
                                        <img src="{{ asset('images/products/product-1-bg-1.png') }}" 
                                             alt="{{ $relProduct->name }}" 
                                             class="w-[160px] h-[160px] object-contain group-hover:scale-105 transition duration-300">
                                    @endif

                                    <div class="absolute left-0 bottom-0 translate-y-full w-full flex items-center justify-center gap-2 pb-4 group-hover:translate-y-0 transition duration-200">
                                        <a href="{{ route('storefront.product', $relProduct->slug) }}" class="px-4 py-2 bg-blue text-white rounded text-xs font-semibold hover:bg-blue-dark shadow-xs transition">
                                            View Details
                                        </a>
                                    </div>
                                </div>

                                <h3 class="font-medium text-sm text-dark hover:text-blue mb-2 line-clamp-2">
                                    <a href="{{ route('storefront.product', $relProduct->slug) }}">
                                        {{ $relProduct->name }}
                                    </a>
                                </h3>
                            </div>

                            <div>
                                <span class="flex items-center gap-2 font-bold text-sm">
                                    <span class="text-dark">${{ number_format($relProduct->new_price, 2) }}</span>
                                    @if($relProduct->old_price && $relProduct->old_price > $relProduct->new_price)
                                        <span class="text-dark-4 line-through font-normal text-xs">${{ number_format($relProduct->old_price, 2) }}</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <!-- ==================== RELATED PRODUCTS END ==================== -->

    </div>

@push('scripts')
<script>
    function switchPreview(url, btn) {
        const preview = document.getElementById('main-preview');
        if (preview) {
            preview.style.opacity = '0.5';
            setTimeout(() => {
                preview.src = url;
                preview.style.opacity = '1';
            }, 100);
        }

        document.querySelectorAll('.thumb-btn').forEach(el => {
            el.classList.remove('border-2', 'border-blue');
            el.classList.add('border', 'border-gray-3');
        });

        btn.classList.remove('border', 'border-gray-3');
        btn.classList.add('border-2', 'border-blue');
    }

    function incrementQty() {
        const input = document.getElementById('cart-quantity');
        let val = parseInt(input.value) || 1;
        input.value = val + 1;
    }

    function decrementQty() {
        const input = document.getElementById('cart-quantity');
        let val = parseInt(input.value) || 1;
        if (val > 1) {
            input.value = val - 1;
        }
    }
</script>
@endpush
@endsection
