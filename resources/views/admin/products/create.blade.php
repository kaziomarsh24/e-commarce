@extends('layouts.admin')

@section('title', 'Add New Product — Bangla Puzzle')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <div class="text-xs text-dark-4 mb-1">
                <a href="{{ route('admin.products.index') }}" class="hover:text-blue hover:underline">Products</a> / <span>Create</span>
            </div>
            <h1 class="text-2xl font-bold text-dark">Add New Product</h1>
        </div>
        <a href="{{ route('admin.products.index') }}"
           class="px-3.5 py-1.5 rounded-lg border border-gray-3 text-dark-4 hover:text-dark hover:bg-gray-2 text-xs font-medium transition">
            &larr; Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl border border-gray-3 p-6 sm:p-8 space-y-6 shadow-xs">

            <!-- Category & Subcategory -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="category_id" class="block text-xs font-bold text-dark uppercase tracking-wider mb-2">
                        Category <span class="text-red">*</span>
                    </label>
                    <select name="category_id"
                            id="category_id"
                            required
                            onchange="loadSubcategories(this.value)"
                            class="w-full bg-white border @error('category_id') border-red @else border-gray-3 @enderror rounded-xl px-4 py-3 text-dark text-sm outline-none focus:border-blue transition">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="subcategory_id" class="block text-xs font-bold text-dark uppercase tracking-wider">
                            Subcategory <span class="text-red">*</span>
                        </label>
                        <span id="subcategory_hint" class="text-[11px] text-dark-4">Select category first</span>
                    </div>
                    <select name="subcategory_id"
                            id="subcategory_id"
                            required
                            class="w-full bg-white border @error('subcategory_id') border-red @else border-gray-3 @enderror rounded-xl px-4 py-3 text-dark text-sm outline-none focus:border-blue transition">
                        <option value="" disabled selected>Select Subcategory</option>
                    </select>
                    @error('subcategory_id')
                        <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Product Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-dark uppercase tracking-wider mb-2">
                    Product Name <span class="text-red">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name') }}"
                       required
                       placeholder="Enter product name"
                       class="w-full bg-white border @error('name') border-red @else border-gray-3 @enderror rounded-xl px-4 py-3 text-dark text-sm outline-none focus:border-blue transition">
                @error('name')
                    <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pricing Tier -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="old_price" class="block text-xs font-bold text-dark uppercase tracking-wider mb-2">
                        Old Price ($)
                    </label>
                    <input type="number"
                           step="0.01"
                           name="old_price"
                           id="old_price"
                           value="{{ old('old_price') }}"
                           placeholder="Enter old price"
                           class="w-full bg-white border @error('old_price') border-red @else border-gray-3 @enderror rounded-xl px-4 py-3 text-dark text-sm outline-none focus:border-blue transition">
                    @error('old_price')
                        <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="new_price" class="block text-xs font-bold text-dark uppercase tracking-wider mb-2">
                        New Price ($) <span class="text-red">*</span>
                    </label>
                    <input type="number"
                           step="0.01"
                           name="new_price"
                           id="new_price"
                           value="{{ old('new_price') }}"
                           required
                           placeholder="Enter price"
                           class="w-full bg-white border @error('new_price') border-red @else border-gray-3 @enderror rounded-xl px-4 py-3 text-dark text-sm outline-none focus:border-blue transition">
                    @error('new_price')
                        <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-xs font-bold text-dark uppercase tracking-wider mb-2">
                    Description <span class="text-red">*</span>
                </label>
                <textarea name="description"
                          id="description"
                          rows="4"
                          required
                          placeholder="Enter product description"
                          class="w-full bg-white border @error('description') border-red @else border-gray-3 @enderror rounded-xl px-4 py-3 text-dark text-sm outline-none focus:border-blue transition">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Primary Image -->
            <div>
                <label class="block text-xs font-bold text-dark uppercase tracking-wider mb-2">
                    Product Image <span class="text-red">*</span>
                </label>
                <div class="flex items-start gap-4">
                    <div class="w-20 h-20 rounded-xl bg-gray-2 border border-gray-3 flex items-center justify-center overflow-hidden flex-shrink-0 text-dark-4 text-xs font-medium">
                        <span id="primary_text">No image</span>
                        <img id="primary_img" src="" alt="Preview" class="hidden w-full h-full object-contain">
                    </div>
                    <div class="flex-1">
                        <input type="file"
                               name="image"
                               id="image"
                               accept="image/*"
                               required
                               onchange="previewPrimaryImage(this)"
                               class="block w-full text-xs text-dark-4 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-2 file:text-dark hover:file:bg-gray-3 transition cursor-pointer">
                        @error('image')
                            <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Gallery Images -->
            <div class="border-t border-gray-3 pt-5">
                <label class="block text-xs font-bold text-dark uppercase tracking-wider mb-1">
                    Gallery Images
                </label>
                <p class="text-xs text-dark-4 mb-3">Upload additional pictures for the product detail slider.</p>

                <input type="file"
                       name="gallery_images[]"
                       id="gallery_images"
                       accept="image/*"
                       multiple
                       onchange="previewGalleryImages(this)"
                       class="block w-full text-xs text-dark-4 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-2 file:text-dark hover:file:bg-gray-3 transition cursor-pointer">

                <div id="gallery_preview_container" class="grid grid-cols-4 sm:grid-cols-6 gap-3 mt-4 hidden"></div>

                @error('gallery_images')
                    <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Status -->
            <div class="border-t border-gray-3 pt-4">
                <input type="hidden" name="is_active" value="0">
                <label class="flex items-center gap-2.5 cursor-pointer select-none">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           id="is_active"
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-blue border-gray-3 focus:ring-blue">
                    <span class="text-xs font-semibold text-dark">Active (Visible in storefront)</span>
                </label>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.products.index') }}"
               class="px-5 py-2.5 rounded-lg border border-gray-3 text-dark text-xs font-semibold hover:bg-gray-2 transition">
                Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-blue text-white text-xs font-semibold hover:bg-blue-dark transition shadow-xs">
                Create Product
            </button>
        </div>

    </form>
</div>

<script>
    // Preview Primary Image
    function previewPrimaryImage(input) {
        const previewImg = document.getElementById('primary_img');
        const previewText = document.getElementById('primary_text');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                if (previewText) previewText.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    // Preview Gallery Images
    function previewGalleryImages(input) {
        const container = document.getElementById('gallery_preview_container');
        container.innerHTML = '';
        if (input.files && input.files.length > 0) {
            container.classList.remove('hidden');
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const card = document.createElement('div');
                    card.className = 'w-20 h-20 rounded-xl bg-gray-2 border border-gray-3 overflow-hidden flex items-center justify-center p-1';
                    card.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-contain">`;
                    container.appendChild(card);
                };
                reader.readAsDataURL(file);
            });
        } else {
            container.classList.add('hidden');
        }
    }

    // Load Subcategories Based on Selected Category
    function loadSubcategories(categoryId, preselectedId = null) {
        const subSelect = document.getElementById('subcategory_id');
        const hint = document.getElementById('subcategory_hint');

        if (!categoryId) {
            subSelect.innerHTML = '<option value="" disabled selected>Select Subcategory</option>';
            if (hint) hint.textContent = 'Select category first';
            return;
        }

        if (hint) hint.textContent = 'Loading...';

        fetch(`/admin/categories/${categoryId}/subcategories`)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    subSelect.innerHTML = '<option value="" disabled selected>No subcategory found</option>';
                    if (hint) hint.textContent = '0 found';
                } else {
                    subSelect.innerHTML = '<option value="" disabled ' + (!preselectedId ? 'selected' : '') + '>Select Subcategory</option>';
                    data.forEach(sub => {
                        const selected = preselectedId && preselectedId == sub.id ? 'selected' : '';
                        subSelect.innerHTML += `<option value="${sub.id}" ${selected}>${sub.name}</option>`;
                    });
                    if (hint) hint.textContent = `${data.length} found`;
                }
            })
            .catch(() => {
                if (hint) hint.textContent = 'Failed to load';
            });
    }

    // Handle old input on validation return
    document.addEventListener('DOMContentLoaded', function() {
        const oldCategory = "{{ old('category_id') }}";
        const oldSubcategory = "{{ old('subcategory_id') }}";
        if (oldCategory) {
            loadSubcategories(oldCategory, oldSubcategory);
        }
    });
</script>
@endsection
