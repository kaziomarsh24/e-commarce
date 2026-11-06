<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use KaziOmar\AtomicCache\Traits\AutoClearsCache;
use KaziOmar\SmartUpload\Traits\HasUploadPurge;
use Illuminate\Support\Str;

#[Fillable([
    'category_id',
    'subcategory_id',
    'name',
    'slug',
    'description',
    'image',
    'gallery_images',
    'old_price',
    'new_price',
    'is_active',
])]
class Product extends Model
{
    use HasFactory, HasUploadPurge, SoftDeletes;
    use AutoClearsCache; //clear cache automatically
    protected $casts = [
        'gallery_images' => 'array',
        'old_price' => 'decimal:2',
        'new_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Files to purge automatically from storage when updated or force-deleted.
     */
    protected array $purgeableFiles = ['image', 'gallery_images'];

    /**
     * Boot model events for automatic and SEO-safe slug handling.
     */
    protected static function booted(): void
    {
        // Auto-generate unique slug on creation
        static::creating(function (Product $product) {
            $source = !empty($product->slug) ? $product->slug : $product->name;
            $product->slug = static::generateUniqueSlug($source);
        });
        // Preserve existing slug during updates to protect SEO ranking unless explicitly edited
        static::updating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = static::generateUniqueSlug($product->name, $product->id);
            } elseif ($product->isDirty('slug')) {
                $product->slug = static::generateUniqueSlug($product->slug, $product->id);
            }
        });
    }
    /**
     * Generate a collision-free, URL-friendly slug.
     */
    public static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;
        while (static::where('slug', $slug)
                     ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                     ->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }
        return $slug;
    }
    /**
     * Use slug instead of ID for implicit route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    /**
     * Calculate dynamic discount percentage from pricing tier.
     */
    public function getDiscountPercentageAttribute(): ?int
    {
        if ($this->old_price && $this->old_price > $this->new_price) {
            return (int) round((($this->old_price - $this->new_price) / $this->old_price) * 100);
        }
        return null;
    }
    /**
     * Get parent category of this product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * Get assigned subcategory of this product.
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }
    /**
     * Scope query to only include active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
