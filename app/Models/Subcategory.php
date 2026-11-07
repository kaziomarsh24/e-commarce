<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use KaziOmar\AtomicCache\Traits\AutoClearsCache;

#[Fillable(['category_id', 'name', 'slug', 'is_active'])]
class Subcategory extends Model
{
    use HasFactory, SoftDeletes;
    use AutoClearsCache; //clear cache automatically

    /**
     * Parent relations to touch/invalidate when this subcategory changes.
     */
    protected array $cacheParents = ['category'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot model events for automatic and SEO-safe slug handling.
     */
    protected static function booted(): void
    {
        // Auto-generate unique slug on creation
        static::creating(function (Subcategory $subcategory) {
            $source = !empty($subcategory->slug) ? $subcategory->slug : $subcategory->name;
            $subcategory->slug = static::generateUniqueSlug($source);
        });
        // Preserve existing slug during updates to protect SEO ranking unless explicitly edited
        static::updating(function (Subcategory $subcategory) {
            if (empty($subcategory->slug)) {
                $subcategory->slug = static::generateUniqueSlug($subcategory->name, $subcategory->id);
            } elseif ($subcategory->isDirty('slug')) {
                $subcategory->slug = static::generateUniqueSlug($subcategory->slug, $subcategory->id);
            }
        });
    }
    /**
     * generate url frindly slug
     */

    public static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $original = $slug;
        $count = 1;
        while (static::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }
        return $slug;
    }

    /**
     * use slug as a primary key instead of id for route model binding
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * active scope for subcategory
     */
    public function scopeActive($query){
        return $query->where('is_active', true);
    }
}
