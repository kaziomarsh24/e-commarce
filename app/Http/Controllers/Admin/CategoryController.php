<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct(
        protected CategoryService $categoryService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $this->categoryService->createCategory(
            $validated,
            $request->file('image')
        );

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $this->categoryService->updateCategory(
            $category,
            $validated,
            $request->file('image')
        );

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $this->categoryService->deleteCategory($category);
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Category deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', $e->getMessage());
        }
    }
}
