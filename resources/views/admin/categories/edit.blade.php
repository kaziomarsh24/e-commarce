@extends('layouts.admin')

@section('title', 'Edit Category — ' . $category->name)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <div class="text-xs text-dark-4 mb-1">
                <a href="{{ route('admin.categories.index') }}" class="hover:text-blue hover:underline">Categories</a> / <span>Edit</span>
            </div>
            <h1 class="text-2xl font-bold text-dark">Edit Category: {{ $category->name }}</h1>
        </div>
        <a href="{{ route('admin.categories.index') }}"
           class="px-3.5 py-1.5 rounded-lg border border-gray-3 text-dark-4 hover:text-dark hover:bg-gray-2 text-xs font-medium transition">
            &larr; Back
        </a>
    </div>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl border border-gray-3 p-6 sm:p-8 space-y-5 shadow-xs">

            <div>
                <label for="name" class="block text-xs font-bold text-dark uppercase tracking-wider mb-2">
                    Category Name <span class="text-red">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $category->name) }}"
                       required
                       placeholder="e.g. Smartphones & Tablets"
                       class="w-full bg-white border @error('name') border-red @else border-gray-3 @enderror rounded-xl px-4 py-3 text-dark text-sm outline-none focus:border-blue transition">
                @error('name')
                    <p class="text-red text-xs mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-dark uppercase tracking-wider mb-2">
                    Cover Image
                </label>
                <div class="flex items-start gap-4">
                    <div id="preview-box" class="w-16 h-16 rounded-xl bg-gray-2 border border-gray-3 flex items-center justify-center overflow-hidden flex-shrink-0 text-dark-4 text-xs">
                        @if($category->image)
                            <img id="preview-img" src="{{ upload_url($category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-contain">
                            <span id="preview-text" class="hidden">Preview</span>
                        @else
                            <img id="preview-img" src="" alt="Preview" class="hidden w-full h-full object-contain">
                            <span id="preview-text">No Img</span>
                        @endif
                    </div>
                    <div class="flex-1">
                        <input type="file"
                               name="image"
                               id="image"
                               accept="image/*"
                               onchange="previewCoverImage(this)"
                               class="block w-full text-xs text-dark-4 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-2 file:text-dark hover:file:bg-gray-3 transition cursor-pointer">
                        @error('image')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <input type="hidden" name="is_active" value="0">
                <label class="flex items-center gap-2.5 cursor-pointer select-none">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           id="is_active"
                           {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 rounded text-blue border-gray-3 focus:ring-blue">
                    <span class="text-xs font-semibold text-dark">Active (Visible in storefront and dropdowns)</span>
                </label>
            </div>

        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.categories.index') }}"
               class="px-5 py-2.5 rounded-lg border border-gray-3 text-dark text-xs font-semibold hover:bg-gray-2 transition">
                Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-blue text-white text-xs font-semibold hover:bg-blue-dark transition shadow-xs">
                Update Category
            </button>
        </div>

    </form>
</div>

<script>
    function previewCoverImage(input) {
        const previewImg = document.getElementById('preview-img');
        const previewText = document.getElementById('preview-text');
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
</script>
@endsection
