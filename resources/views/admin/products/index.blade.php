@extends('layouts.admin')

@section('title', 'Products — Bangla Puzzle')

@section('content')
<div class="space-y-6">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-dark">Products</h1>
            <p class="text-xs text-dark-4 mt-1">Manage catalog products.</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
           class="px-4 py-2 rounded-md bg-blue text-white font-medium text-xs hover:bg-blue-dark transition flex items-center gap-2 self-start sm:self-auto shadow-xs">
            <span>+</span>
            <span>Add Product</span>
        </a>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-xl border border-gray-3 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-1 border-b border-gray-3 text-dark-4 font-semibold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4 w-16">Image</th>
                        <th class="py-3.5 px-4">Product Name & Slug</th>
                        <th class="py-3.5 px-4">Category & Subcategory</th>
                        <th class="py-3.5 px-4">Pricing</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-3">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-1 transition">
                        <td class="py-3 px-4 w-16">
                            <div class="w-12 h-12 rounded-lg bg-gray-2 border border-gray-3 overflow-hidden flex items-center justify-center p-1">
                                @if($product->image)
                                {{-- @dd(upload_url($product->image)) --}}
                                    <img src="{{ upload_url($product->image, variant: 'thumb') }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                                @else
                                    <svg class="w-5 h-5 text-dark-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-bold text-dark text-sm">{{ $product->name }}</div>
                            <div class="font-mono text-[11px] text-dark-4 mt-0.5">/products/{{ $product->slug }}</div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="space-y-0.5">
                                <div class="font-semibold text-dark text-xs">{{ $product->category->name ?? 'N/A' }}</div>
                                <div class="text-[11px] text-dark-4 flex items-center gap-1">
                                    <span>&rarr;</span>
                                    <span>{{ $product->subcategory->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="font-bold text-dark text-sm">${{ number_format($product->new_price, 2) }}</div>
                            @if($product->old_price)
                                <div class="text-[11px] text-dark-4 line-through">${{ number_format($product->old_price, 2) }}</div>
                                @if($product->discount_percentage)
                                    <div class="text-[10px] text-green font-semibold">Save {{ $product->discount_percentage }}%</div>
                                @endif
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            @if($product->is_active)
                                <span class="px-2 py-0.5 rounded-full bg-green/10 text-green font-medium text-[11px]">Active</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-red/10 text-red font-medium text-[11px]">Inactive</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="px-2.5 py-1 rounded border border-gray-3 text-dark hover:bg-gray-2 transition font-medium">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 rounded border border-red/20 bg-red/5 text-red hover:bg-red/10 transition font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 px-4 text-center text-dark-4 text-xs">
                            No products found.
                            <a href="{{ route('admin.products.create') }}" class="text-blue hover:underline ml-1">Create one &rarr;</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="p-4 border-t border-gray-3">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
