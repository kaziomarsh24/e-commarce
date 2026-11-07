<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Services\Admin\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getAllProducts();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $this->productService->createProduct(
            $request->validated(),
            $request->file('image'),
            $request->file('gallery_images', [])
        );

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::active()->orderBy('name')->get();
        $subcategories = Subcategory::where('category_id', $product->category_id)->active()->orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productService->updateProduct(
            $product,
            $request->validated(),
            $request->file('image'),
            $request->file('gallery_images', [])
        );

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $this->productService->deleteProduct($product);

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.products.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Fetch active subcategories for dynamic dependent dropdown.
     */
    public function getSubcategories(int|string $category): JsonResponse
    {
        $cat = is_numeric($category)
            ? Category::find($category)
            : Category::where('slug', $category)->first();

        if (!$cat) {
            return response()->json([]);
        }

        $subcategories = $cat->subcategories()
            ->active()
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($subcategories);
    }
}
