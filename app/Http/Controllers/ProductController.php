<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function show($identifier)
    {
        // Try to find by slug first, then by ID
        $product = Product::with('category')->where('status', 'active');
        
        if (is_numeric($identifier)) {
            $product = $product->where('id', $identifier)->first();
        } else {
            $product = $product->where('slug', $identifier)->first();
            
            // If not found by slug, try by ID as fallback
            if (!$product) {
                $product = Product::with('category')
                    ->where('status', 'active')
                    ->where('id', $identifier)
                    ->first();
            }
        }

        if (!$product) {
            abort(404, 'Product not found');
        }

        // If product doesn't have a slug, generate and save it
        if (empty($product->slug)) {
            $product->slug = Product::generateUniqueSlug($product->name);
            $product->save();
        }

        // Get related products from same category
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit(4)
            ->get()
            ->map(function($relatedProduct) {
                // Ensure related products have slugs too
                if (empty($relatedProduct->slug)) {
                    $relatedProduct->slug = Product::generateUniqueSlug($relatedProduct->name);
                    $relatedProduct->save();
                }
                
                return [
                    'id' => $relatedProduct->id,
                    'name' => $relatedProduct->name,
                    'slug' => $relatedProduct->slug,
                    'price' => $relatedProduct->price,
                    'sales_price' => $relatedProduct->sales_price,
                    'final_price' => $relatedProduct->final_price,
                    'has_discount' => $relatedProduct->hasDiscount(),
                    'main_image_url' => $relatedProduct->main_image_url,
                ];
            });

        // Transform product data
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'product_code' => $product->product_code,
            'description' => $product->description,
            'short_description' => $product->short_description,
            'tags' => $product->tags,
            'additional_info' => $product->additional_info,
            'price' => $product->price,
            'sales_price' => $product->sales_price,
            'final_price' => $product->final_price,
            'has_discount' => $product->hasDiscount(),
            'discount_percentage' => $product->discount_percentage,
            'stock' => $product->stock,
            'category' => $product->category->name,
            'category_id' => $product->category_id,
            'main_image_url' => $product->main_image_url,
            'gallery_image_urls' => $product->gallery_image_urls,
            'slug' => $product->slug,
            'rating' => 4.8,
            'reviews_count' => rand(50, 300),
            'is_featured' => $product->stock > 10,
            'is_new' => $product->created_at->isAfter(now()->subDays(30)),
        ];

        return view('single-product', compact('productData', 'relatedProducts'));
    }
}