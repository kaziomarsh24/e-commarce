<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Services\StorefrontService;
use Illuminate\Contracts\View\View;

class StorefrontController extends Controller
{
    public function __construct(
        protected StorefrontService $storefrontService
    ) {}

    /**
     * Display the storefront homepage.
     */
    public function index(): View
    {
        $heroAndDeals       = $this->storefrontService->getHeroAndDeals();
        $featuredCategories = $this->storefrontService->getFeaturedCategories();
        $latestProducts     = $this->storefrontService->getLatestProducts(8);

        return view('storefront.index', compact('heroAndDeals', 'featuredCategories', 'latestProducts'));
    }

    /**
     * Display products by category with optional subcategory filtering.
     */
    public function category(Category $category, ?Subcategory $subcategory = null): View
    {
        abort_unless($category->is_active, 404);

        if ($subcategory) {
            abort_unless($subcategory->is_active && $subcategory->category_id === $category->id, 404);
        }

        $subcategories = $category->subcategories()
            ->active()
            ->withCount(['products' => fn($q) => $q->active()])
            ->orderBy('name')
            ->get();

        $products = $this->storefrontService->getCategoryProducts($category, $subcategory?->slug);

        return view('storefront.category', compact('category', 'subcategory', 'subcategories', 'products'));
    }

    /**
     * Display a single product's detail page.
     */
    public function product(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $details = $this->storefrontService->getProductDetails($product);

        return view('storefront.product', $details);
    }
}
