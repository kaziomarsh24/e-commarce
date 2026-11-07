@extends('layouts.admin')

@section('title', 'Edit Subcategory — ' . $subcategory->name)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <div class="text-xs text-dark-4 mb-1">
                <a href="{{ route('admin.subcategories.index') }}" class="hover:text-blue hover:underline">Subcategories</a> / <span>Edit</span>
            </div>
            <h1 class="text-2xl font-bold text-dark">Edit Subcategory: {{ $subcategory->name }}</h1>
        </div>
        <a href="{{ route('admin.subcategories.index') }}"
           class="px-3.5 py-1.5 rounded-lg border border-gray-3 text-dark-4 hover:text-dark hover:bg-gray-2 text-xs font-medium transition">
            &larr; Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.subcategories.update', $subcategory) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl border border-gray-3 p-6 sm:p-8 space-y-5 shadow-xs">

            <!-- Parent Category -->
            <div>
                <label for="category_id" class="block text-xs font-bold text-dark uppercase tracking-wider mb-2">
                    Parent Category <span class="text-red">*</span>
                </label>
                <select name="category_id"
                        id="category_id"
                        required
                        class="w-full bg-white border @error('category_id') border-red @else border-gray-3 @enderror rounded-xl px-4 py-3 text-dark text-sm outline-none focus:border-blue transition">
                    <option value="" disabled>Select Parent Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subcategory Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-dark uppercase tracking-wider mb-2">
                    Subcategory Name <span class="text-red">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $subcategory->name) }}"
                       required
                       placeholder="e.g. Flagship Phones"
                       class="w-full bg-white border @error('name') border-red @else border-gray-3 @enderror rounded-xl px-4 py-3 text-dark text-sm outline-none focus:border-blue transition">
                @error('name')
                    <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Status -->
            <div class="pt-2">
                <input type="hidden" name="is_active" value="0">
                <label class="flex items-center gap-2.5 cursor-pointer select-none">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           id="is_active"
                           {{ old('is_active', $subcategory->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-blue border-gray-3 focus:ring-blue">
                    <span class="text-xs font-semibold text-dark">Active (Visible in storefront and dropdowns)</span>
                </label>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.subcategories.index') }}"
               class="px-5 py-2.5 rounded-lg border border-gray-3 text-dark text-xs font-semibold hover:bg-gray-2 transition">
                Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-blue text-white text-xs font-semibold hover:bg-blue-dark transition shadow-xs">
                Update Subcategory
            </button>
        </div>

    </form>
</div>
@endsection
