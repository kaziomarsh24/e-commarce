<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use KaziOmar\AtomicCache\Traits\HasAtomicCache;

class StorefrontService
{
    use HasAtomicCache;

    /**
     * Cache tag/resource namespace.
     */
    protected string $cacheResource = 'storefront';

    /**
     * Get active categories with active subcategories for navigation.
     */
    public function getNavigationCategories()
    {
        $callback = fn() => Category::with(['subcategories' => fn($q) => $q->active()->orderBy('name')])
            ->active()
            ->orderBy('name')
            ->get();

        return $this->cache(__FUNCTION__, func_get_args(), $callback, ttl: 86400, perUserOrTags: ['categories', 'subcategories']);
    }

    /**
     * Get hero banner product and side promotional deals.
     */
    public function getHeroAndDeals(): array
    {
        $callback = function () {
            $hero = Product::active()
                ->whereNotNull('old_price')
                ->whereColumn('old_price', '>', 'new_price')
                ->latest()
                ->first() ?? Product::active()->latest()->first();

            $deals = Product::active()
                ->when($hero, fn($q) => $q->where('id', '!=', $hero->id))
                ->latest()
                ->take(2)
                ->get();

            return [
                'hero'  => $hero,
                'deals' => $deals,
            ];
        };

        return $this->cache(__FUNCTION__, func_get_args(), $callback, ttl: 1800, perUserOrTags: ['products']);
    }

    /**
     * Get popular categories for the storefront circle carousel/grid.
     */
    public function getFeaturedCategories()
    {
        $callback = fn() => Category::active()
            ->withCount('products')
            ->take(8)
            ->get();

        return $this->cache(__FUNCTION__, func_get_args(), $callback, ttl: 3600, perUserOrTags: ['categories']);
    }

    /**
     * Get latest active products for the storefront catalog grid.
     */
    public function getLatestProducts(int $limit = 8)
    {
        $callback = fn() => Product::active()
            ->with(['category', 'subcategory'])
            ->latest()
            ->take($limit)
            ->get();

        return $this->cache(__FUNCTION__, func_get_args(), $callback, ttl: 900, perUserOrTags: ['products']);
    }

    /**
     * Get products for a specific category and optional subcategory filter with pagination.
     * Cached with automatic request query tracking (page, filters) and virtual tags.
     */
    public function getCategoryProducts(Category $category, ?string $subcategorySlug = null)
    {
        $callback = function () use ($category, $subcategorySlug) {
            $query = $category->products()
                ->active()
                ->with(['category', 'subcategory'])
                ->latest();

            if ($subcategorySlug) {
                $query->whereHas('subcategory', fn($q) => $q->where('slug', $subcategorySlug));
            }

            return $query->paginate(12);
        };

        return $this->cache( __FUNCTION__, func_get_args(), $callback, ttl: 600, perUserOrTags: ['products', 'categories']
        );
    }

    /**
     * Get single product detail with related catalog items.
     */
    public function getProductDetails(Product $product): array
    {
        $product->load(['category', 'subcategory']);

        $callback = fn() => Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        $related = $this->cache(
            'getRelatedProducts',
            [$product->category_id, $product->id],
            $callback,
            ttl: 1800,
            perUserOrTags: ['products']
        );

        return [
            'product' => $product,
            'related' => $related,
        ];
    }
}
