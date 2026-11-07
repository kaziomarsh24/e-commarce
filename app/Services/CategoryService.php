<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\UploadedFile;
use KaziOmar\AtomicCache\Traits\HasAtomicCache;
use KaziOmar\SmartUpload\Facades\Upload;

class CategoryService
{
    use HasAtomicCache;
    /**
     * Retrieve all categories.
     */
    public function getAllCategories()
    {
        $callback = fn() => Category::withCount('products')
                            ->where('is_active', true)
                            ->get();
        return $this->cache(__FUNCTION__,func_get_args(),$callback, ttl:3600);
    }
    /**
     * Get category by slug.
     */
    public function getCategoryBySlug(string $slug): ?Category
    {
        $callback = fn () => Category::with(['subcategories' => fn ($q) => $q->active()])
                                     ->where('slug', $slug)
                                     ->firstOrFail();
        return $this->cache(__FUNCTION__, func_get_args(), $callback, ttl: 3600);
    }
    /**
     * Create a new category.
     */
    public function createCategory(array $data, ?UploadedFile $image = null): Category
    {
        if ($image) {
            $upload = Upload::file($image)->scaleDown(600, 600)->save('categories');
            $data['image'] = $upload->path;
        }
        return Category::create($data);
    }

    /**
     * Update an existing category.
     */
    public function updateCategory(Category $category, array $data, ?UploadedFile $image = null): bool
    {
        if ($image) {
            $upload = Upload::file($image)->scaleDown(600, 600)->save('categories');
            $data['image'] = $upload->path; //delete old file autometically by HasUploadPurge trait in category model
        }
        return $category->update($data);
    }

    /**
     * SoftDelete a category.
     */
    public function deleteCategory(Category $category): ?bool
    {
        $productExists = $category->products()->exists();
        $subcategoryExists = $category->subcategories()->exists();
        if ($productExists || $subcategoryExists) {
            throw new \Exception('Cannot delete category with associated products or subcategories.');
        }
        return $category->delete();
    }
}
