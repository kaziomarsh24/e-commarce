@extends('layouts.admin')

@section('title', 'Subcategories — Bangla Puzzle')

@section('content')
<div class="space-y-6">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-dark">Subcategories</h1>
            <p class="text-xs text-dark-4 mt-1">Manage secondary classifications associated with main parent categories.</p>
        </div>
        <a href="{{ route('admin.subcategories.create') }}"
           class="px-4 py-2 rounded-md bg-blue text-white font-medium text-xs hover:bg-blue-dark transition flex items-center gap-2 self-start sm:self-auto shadow-xs">
            <span>+</span>
            <span>Add Subcategory</span>
        </a>
    </div>

    <!-- Subcategories Table -->
    <div class="bg-white rounded-xl border border-gray-3 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-1 border-b border-gray-3 text-dark-4 font-semibold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="py-3.5 px-4">Subcategory Name & Slug</th>
                        <th class="py-3.5 px-4">Parent Category</th>
                        <th class="py-3.5 px-4">Total Products</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-3">
                    @forelse($subcategories as $subcategory)
                    <tr class="hover:bg-gray-1 transition">
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-dark text-sm">{{ $subcategory->name }}</div>
                            <div class="font-mono text-[11px] text-dark-4 mt-0.5">
                                /category/{{ $subcategory->category->slug ?? 'uncategorized' }}/{{ $subcategory->slug }}
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            @if($subcategory->category)
                                <span class="px-2.5 py-1 rounded bg-blue/10 text-blue font-semibold text-xs">
                                    {{ $subcategory->category->name }}
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded bg-gray-2 text-dark-4 font-medium text-xs">
                                    N/A
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 font-semibold text-dark">
                            {{ $subcategory->products_count }} {{ Str::plural('Product', $subcategory->products_count) }}
                        </td>
                        <td class="py-3.5 px-4">
                            @if($subcategory->is_active)
                                <span class="px-2 py-0.5 rounded-full bg-green/10 text-green font-medium text-[11px]">Active</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full bg-red/10 text-red font-medium text-[11px]">Inactive</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('admin.subcategories.edit', $subcategory) }}"
                                   class="px-2.5 py-1 rounded border border-gray-3 text-dark hover:bg-gray-2 transition font-medium">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.subcategories.destroy', $subcategory) }}" onsubmit="return confirm('Delete subcategory? Active products must be removed first.');" class="inline">
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
                        <td colspan="5" class="py-8 px-4 text-center text-dark-4 text-xs">
                            No subcategories found.
                            <a href="{{ route('admin.subcategories.create') }}" class="text-blue hover:underline ml-1">Create one &rarr;</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($subcategories->hasPages())
            <div class="p-4 border-t border-gray-3">
                {{ $subcategories->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
