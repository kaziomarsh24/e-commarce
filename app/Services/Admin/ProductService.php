<?php

namespace App\Services\Admin;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use KaziOmar\SmartUpload\Facades\Upload;

class ProductService
{
    /**
     * Retrieve all products for admin listing.
     */
    public function getAllProducts()
    {
        return Product::with(['category', 'subcategory'])
            ->latest()
            ->paginate(15);
    }

    /**
     * Create a new product with image and gallery handling.
     */
    public function createProduct(array $data, ?UploadedFile $image = null, array $galleryImages = []): Product
    {
        if ($image) {
            // $upload = Upload::file($image)->scaleDown(800, 800)->save('products');
            $upload = Upload::file($image)
                ->variants([
                    'thumb'   => ['fit' => [150, 150]],
                ])
                ->save('products');

            $data['image'] = $upload->path;
        }

        if (!empty($galleryImages)) {
            // $galleryPaths = Upload::files($galleryImages)->scaleDown(800, 800)->save('products/gallery');
            $galleryPaths = Upload::files($galleryImages)
                ->variants([
                    'thumb'   => ['fit' => [150, 150]],
                ])
                ->save('products/gallery');
            $data['gallery_images'] = $galleryPaths->paths();
        }

        return Product::create($data);
    }

    /**
     * Update an existing product.
     */
    public function updateProduct(Product $product, array $data, ?UploadedFile $image = null, array $galleryImages = []): bool
    {
        if ($image) {
            $upload = Upload::file($image)->variants([
                'thumb'   => ['fit' => [150, 150]],
            ])->save('products');
            $data['image'] = $upload->path; //delete old file autometically by HasUploadPurge trait in product model
        }

        if (!empty($galleryImages)) {
            $galleryPaths = Upload::files($galleryImages)->variants([
                'thumb'   => ['fit' => [150, 150]],
            ])->save('products/gallery');
            $data['gallery_images'] = $galleryPaths->paths(); //delete old files autometically by HasUploadPurge trait in product model
        }

        return $product->update($data);
    }

    /**
     * SoftDelete a product.
     */
    public function deleteProduct(Product $product): ?bool
    {
        return $product->delete();
    }
}
