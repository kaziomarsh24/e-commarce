<?php

namespace App\Services\Admin;

use App\Models\Subcategory;

class SubcategoryService
{
    /**
     * Retrieve all subcategories for admin listing.
     */
    public function getAllSubcategories()
    {
        return Subcategory::with('category')
            ->withCount('products')
            ->latest()
            ->paginate(10);
    }

    /**
     * Create a new subcategory.
     */
    public function createSubcategory(array $data): Subcategory
    {
        return Subcategory::create($data);
    }

    /**
     * Update an existing subcategory.
     */
    public function updateSubcategory(Subcategory $subcategory, array $data): bool
    {
        return $subcategory->update($data);
    }

    /**
     * SoftDelete a subcategory.
     */
    public function deleteSubcategory(Subcategory $subcategory): ?bool
    {
        if ($subcategory->products()->exists()) {
            throw new \Exception('Cannot delete subcategory with associated products.');
        }

        return $subcategory->delete();
    }
}
