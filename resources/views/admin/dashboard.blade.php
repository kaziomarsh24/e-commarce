@extends('layouts.admin')

@section('title', 'Admin Dashboard — Bangla Puzzle')

@section('content')
<div class="space-y-8">

    {{-- Top Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-dark">Dashboard Overview</h1>
            <p class="text-xs text-dark-4 mt-1">Summary of store catalog, active categories, and latest products.</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="px-4 py-2 rounded-md bg-blue text-white font-medium text-xs hover:bg-blue-dark transition flex items-center gap-2 self-start sm:self-auto shadow-xs">
            <span>+</span>
            <span>Add New Product</span>
        </a>
    </div>

    <!-- Quick Stats Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        <!-- Total Categories -->
        <div class="bg-white rounded-xl border border-gray-3 p-5 shadow-xs">
            <div class="text-[11px] font-semibold text-dark-4 uppercase tracking-wider mb-1">Total Categories</div>
            <div class="text-3xl font-bold text-dark">{{ $stats['total_categories'] ?? 0 }}</div>
            <a href="{{ route('admin.categories.index') }}"
                class="text-xs font-medium text-blue hover:underline mt-3 inline-block">Manage categories &rarr;</a>
        </div>

        <!-- Total Subcategories -->
        <div class="bg-white rounded-xl border border-gray-3 p-5 shadow-xs">
            <div class="text-[11px] font-semibold text-dark-4 uppercase tracking-wider mb-1">Total Subcategories</div>
            <div class="text-3xl font-bold text-dark">{{ $stats['total_subcategories'] ?? 0 }}</div>
            <a href="{{ route('admin.subcategories.index') }}"
                class="text-xs font-medium text-blue hover:underline mt-3 inline-block">Manage subcategories &rarr;</a>
        </div>

        <!-- Total Products -->
        <div class="bg-white rounded-xl border border-gray-3 p-5 shadow-xs">
            <div class="text-[11px] font-semibold text-dark-4 uppercase tracking-wider mb-1">Total Products</div>
            <div class="text-3xl font-bold text-dark">{{ $stats['total_products'] ?? 0 }}</div>
            <a href="{{ route('admin.products.index') }}"
                class="text-xs font-medium text-blue hover:underline mt-3 inline-block">Manage products &rarr;</a>
        </div>

        <!-- Active Catalog Items -->
        <div class="bg-white rounded-xl border border-gray-3 p-5 shadow-xs">
            <div class="text-[11px] font-semibold text-dark-4 uppercase tracking-wider mb-1">Active Catalog Items</div>
            <div class="text-3xl font-bold text-green">{{ $stats['active_proudcts_count'] ?? 0 }}</div>
            <span class="text-xs text-dark-4 mt-3 inline-block">Visible on storefront</span>
        </div>
    </div>

    <!-- Recent Products Table -->
    <div class="bg-white rounded-xl border border-gray-3 overflow-hidden shadow-xs">
        <div class="px-6 py-4 border-b border-gray-3 flex items-center justify-between">
            <h2 class="font-bold text-sm text-dark">Recently Added Products</h2>
            <a href="{{ route('admin.products.create') }}" class="text-xs font-semibold text-blue hover:underline">+ New
                Product</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead
                    class="bg-gray-1 border-b border-gray-3 text-dark-4 font-semibold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-6">Product</th>
                        <th class="py-3.5 px-6">Category / Subcategory</th>
                        <th class="py-3.5 px-6">Price</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-3">
                    @forelse($recent_products as $product)
                    <tr class="hover:bg-gray-1 transition">
                        <td class="py-3 px-6">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-md bg-gray-2 border border-gray-3 flex items-center justify-center p-1 overflow-hidden flex-shrink-0">
                                    @if($product->image)
                                    <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}" class="h-full w-full object-contain">
                                    @else
                                    <span class="text-[10px] text-dark-4 font-bold">N/A</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-bold text-dark">{{ $product->name }}</div>
                                    <div class="text-[11px] text-dark-4 font-mono">/products/{{ $product->slug }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-6">
                            <div class="text-dark font-medium">{{ $product->category->name ?? 'Uncategorized' }}</div>
                            @if($product->subcategory)
                            <div class="text-[11px] text-dark-4">&rarr; {{ $product->subcategory->name }}</div>
                            @endif
                        </td>
                        <td class="py-3 px-6">
                            <div class="font-bold text-dark">${{ number_format($product->new_price, 2) }}</div>
                            @if($product->old_price)
                            <div class="text-[11px] text-dark-4 line-through">${{ number_format($product->old_price, 2)
                                }}</div>
                            @endif
                        </td>
                        <td class="py-3 px-6">
                            @if($product->is_active)
                            <span
                                class="px-2 py-0.5 rounded-full bg-green/10 text-green font-medium text-[11px]">Active</span>
                            @else
                            <span
                                class="px-2 py-0.5 rounded-full bg-red/10 text-red font-medium text-[11px]">Inactive</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-right">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="text-blue font-semibold hover:underline">Edit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-dark-4">
                            No products found. <a href="{{ route('admin.products.create') }}"
                                class="text-blue underline font-medium">Create your first product</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-3 bg-gray-1 text-center">
            <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-blue hover:underline">View
                All Products &rarr;</a>
        </div>
    </div>

</div>
@endsection
