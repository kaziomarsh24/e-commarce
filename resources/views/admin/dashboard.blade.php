@extends('layouts.admin')

@section('title', 'Admin Dashboard — Bangla Puzzle')
@section('content')
        {{-- top bar --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-dark">Dashboard Overview</h1>
                <p class="text-xs text-dark-4 mt-1">Summary of store catalog, active categories, and latest products.</p>
            </div>
            <a href="product-create.html" class="px-4 py-2 rounded-md bg-blue text-white font-medium text-xs hover:bg-blue-dark transition flex items-center gap-2">
                <span>+</span>
                <span>Add New Product</span>
            </a>
        </div>

        <!-- Quick Stats Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white rounded-xl border border-gray-3 p-5 shadow-xs">
                <div class="text-[11px] font-semibold text-dark-4 uppercase tracking-wider mb-1">Total Categories</div>
                <div class="text-3xl font-bold text-dark">{{ $dashboardStats->total_categories ?? 0 }}</div>
                <a href="{{ route('admin.categories.index') }}" class="text-xs font-medium text-blue hover:underline mt-3 inline-block">Manage categories &rarr;</a>
            </div>

            <div class="bg-white rounded-xl border border-gray-3 p-5 shadow-xs">
                <div class="text-[11px] font-semibold text-dark-4 uppercase tracking-wider mb-1">Total Subcategories</div>
                <div class="text-3xl font-bold text-dark">{{ $dashboardState->total_subcategories ?? 0 }}</div>
                <a href="{{ route('admin.subcategories.index') }}" class="text-xs font-medium text-blue hover:underline mt-3 inline-block">Manage subcategories &rarr;</a>
            </div>

            <div class="bg-white rounded-xl border border-gray-3 p-5 shadow-xs">
                <div class="text-[11px] font-semibold text-dark-4 uppercase tracking-wider mb-1">Total Products</div>
                <div class="text-3xl font-bold text-dark">{{ $dashboardState->total_products ?? 0 }}</div>
                <a href="{{ route('admin.products.index') }}" class="text-xs font-medium text-blue hover:underline mt-3 inline-block">Manage products &rarr;</a>
            </div>

            <div class="bg-white rounded-xl border border-gray-3 p-5 shadow-xs">
                <div class="text-[11px] font-semibold text-dark-4 uppercase tracking-wider mb-1">Active Catalog Items</div>
                <div class="text-3xl font-bold text-green">{{ $dashboardState->active_proudcts_count ?? 0 }}</div>
                <span class="text-xs text-dark-4 mt-3 inline-block">Visible on storefront</span>
            </div>
        </div>

        <!-- Recent Products Table -->
        <div class="bg-white rounded-xl border border-gray-3 overflow-hidden shadow-xs">
            <div class="px-6 py-4 border-b border-gray-3 flex items-center justify-between">
                <h2 class="font-bold text-sm text-dark">Recently Added Products</h2>
                <a href="product-create.html" class="text-xs font-semibold text-blue hover:underline">+ New Product</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-gray-1 border-b border-gray-3 text-dark-4 font-semibold uppercase text-[11px] tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Product</th>
                            <th class="py-3.5 px-6">Category / Subcategory</th>
                            <th class="py-3.5 px-6">Price</th>
                            <th class="py-3.5 px-6">Status</th>
                            <th class="py-3.5 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-3">
                        <tr class="hover:bg-gray-1 transition">
                            <td class="py-3 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-md bg-gray-2 flex items-center justify-center p-1">
                                        <img src="../images/products/product-2-bg-1.png" alt="iPhone 14 Plus" class="h-full object-contain">
                                    </div>
                                    <div>
                                        <div class="font-bold text-dark">iPhone 14 Plus , 6/128GB</div>
                                        <div class="text-[11px] text-dark-4 font-mono">/product/iphone-14-plus</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="text-dark font-medium">Mobile & Tablets</div>
                                <div class="text-[11px] text-dark-4">&rarr; Flagship Phones</div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="font-bold text-dark">$99.00</div>
                                <div class="text-[11px] text-dark-4 line-through">$899.00</div>
                            </td>
                            <td class="py-3 px-6">
                                <span class="px-2 py-0.5 rounded-full bg-green/10 text-green font-medium text-[11px]">Active</span>
                            </td>
                            <td class="py-3 px-6 text-right">
                                <a href="product-edit.html" class="text-blue font-semibold hover:underline">Edit</a>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-1 transition">
                            <td class="py-3 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-md bg-gray-2 flex items-center justify-center p-1">
                                        <img src="../images/products/product-1-bg-1.png" alt="Gamepad" class="h-full object-contain">
                                    </div>
                                    <div>
                                        <div class="font-bold text-dark">Havit HV-G69 USB Gamepad</div>
                                        <div class="text-[11px] text-dark-4 font-mono">/product/havit-gamepad</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="text-dark font-medium">Games & Videos</div>
                                <div class="text-[11px] text-dark-4">&rarr; Accessories</div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="font-bold text-dark">$29.00</div>
                                <div class="text-[11px] text-dark-4 line-through">$59.00</div>
                            </td>
                            <td class="py-3 px-6">
                                <span class="px-2 py-0.5 rounded-full bg-green/10 text-green font-medium text-[11px]">Active</span>
                            </td>
                            <td class="py-3 px-6 text-right">
                                <a href="product-edit.html" class="text-blue font-semibold hover:underline">Edit</a>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-1 transition">
                            <td class="py-3 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-md bg-gray-2 flex items-center justify-center p-1">
                                        <img src="../images/products/product-3-bg-1.png" alt="iMac" class="h-full object-contain">
                                    </div>
                                    <div>
                                        <div class="font-bold text-dark">Apple iMac M1 24-inch 2021</div>
                                        <div class="text-[11px] text-dark-4 font-mono">/product/apple-imac-m1</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="text-dark font-medium">Laptop & PC</div>
                                <div class="text-[11px] text-dark-4">&rarr; Workstations</div>
                            </td>
                            <td class="py-3 px-6">
                                <div class="font-bold text-dark">$29.00</div>
                                <div class="text-[11px] text-dark-4 line-through">$59.00</div>
                            </td>
                            <td class="py-3 px-6">
                                <span class="px-2 py-0.5 rounded-full bg-green/10 text-green font-medium text-[11px]">Active</span>
                            </td>
                            <td class="py-3 px-6 text-right">
                                <a href="product-edit.html" class="text-blue font-semibold hover:underline">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-3 bg-gray-1 text-center">
                <a href="products.html" class="text-xs font-semibold text-blue hover:underline">View All 8 Products &rarr;</a>
            </div>
        </div>

@endsection
