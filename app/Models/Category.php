<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use KaziOmar\SmartUpload\Traits\HasUploadPurge;

#[Fillable(['name', 'slug', 'image', 'description', 'is_active'])]
class Category extends Model
{
    use HasFactory, SoftDeletes, HasUploadPurge;

    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    /**
     * Files to purge automatically from storage when updated or force-deleted.
     */
    protected array $purgeableFiles = ['image'];

    /**
     * Boot model events for automatic and SEO-safe slug handling.
     */
    protected static function booted(): void
    {
        //auto generate unique slug
        static::creating(function (Category $category) {
            $source = !empty($category->slug) ? $category->slug : $category->name;
            $category->slug = static::generateUniqueSlug($source);
        });

        // Preserve existing slug during updates to protect SEO ranking unless explicitly edited
        static::updating(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = static::generateUniqueSlug($category->name, $category->id);
            } elseif ($category->isDirty('slug')) {
                $category->slug = static::generateUniqueSlug($category->slug, $category->id);
            }
        });
    }

    //generate url frindly slug
    public static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
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

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
