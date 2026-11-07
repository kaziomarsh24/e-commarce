<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Services\Admin\SubcategoryService;

class SubcategoryController extends Controller
{
    public function __construct(
        protected SubcategoryService $subcategoryService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = $this->subcategoryService->getAllSubcategories();

        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('admin.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubcategoryRequest $request)
    {
        $this->subcategoryService->createSubcategory($request->validated());

        return redirect()
            ->route('admin.subcategories.index')
            ->with('success', 'Subcategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        return redirect()->route('admin.subcategories.edit', $subcategory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        $this->subcategoryService->updateSubcategory($subcategory, $request->validated());

        return redirect()
            ->route('admin.subcategories.index')
            ->with('success', 'Subcategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        try {
            $this->subcategoryService->deleteSubcategory($subcategory);

            return redirect()
                ->route('admin.subcategories.index')
                ->with('success', 'Subcategory deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.subcategories.index')
                ->with('error', $e->getMessage());
        }
    }
}
