<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use KaziOmar\AtomicCache\Traits\HasAtomicCache;

class DashboardService
{
    public function getDashboardStats(): array
    {
        return [
            'stats' => [
                'total_categories'    => Category::count(),
                'total_subcategories' => Subcategory::count(),
                'total_products'      => Product::count(),
                'active_proudcts_count'  => Product::where('is_active', true)->count()
            ],
            'recent_products' => Product::with(['category', 'subcategory'])
                ->latest()
                ->take(5)
                ->get(),
        ];
    }
}
