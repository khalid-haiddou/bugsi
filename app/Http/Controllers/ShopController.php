<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // ADD THIS LINE

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('status', 'active');

        // Apply category filter
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('short_description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('tags', 'like', '%' . $searchTerm . '%');
            });
        }

        // Apply price range filter
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Apply sorting
        $sort = $request->get('sort', 'featured');
        switch ($sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'featured':
            default:
                $query->orderByRaw('CASE WHEN stock > 0 THEN 0 ELSE 1 END')
                      ->orderBy('created_at', 'desc');
                break;
        }

        // Pagination
        $products = $query->paginate(12)->withQueryString();

        // Get categories for filter
        $categories = Category::orderBy('name')->get();

        // Get price range for filters
        $priceRange = Product::where('status', 'active')
            ->selectRaw('MIN(price) as min_price, MAX(price) as max_price')
            ->first();

        // Transform products for frontend
        $productsData = $products->getCollection()->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'product_code' => $product->product_code,
                'short_description' => $product->short_description,
                'price' => $product->price,
                'sales_price' => $product->sales_price,
                'final_price' => $product->final_price,
                'has_discount' => $product->hasDiscount(),
                'discount_percentage' => $product->discount_percentage,
                'stock' => $product->stock,
                'category' => $product->category->name,
                'category_id' => $product->category_id,
                'main_image_url' => $product->main_image_url,
                'slug' => Str::slug($product->name), // CHANGED FROM str_slug() to Str::slug()
                'is_featured' => $product->stock > 10,
                'is_new' => $product->created_at->isAfter(now()->subDays(30)),
                'rating' => 4.8,
                'reviews_count' => rand(50, 300)
            ];
        });

        return view('shop', compact(
            'products',
            'productsData',
            'categories',
            'priceRange'
        ));
    }

    // AJAX endpoint for filtering/sorting
    public function filter(Request $request)
    {
        $query = Product::with('category')->where('status', 'active');

        // Apply filters (same logic as index method)
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('short_description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('tags', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Apply sorting
        $sort = $request->get('sort', 'featured');
        switch ($sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'featured':
            default:
                $query->orderByRaw('CASE WHEN stock > 0 THEN 0 ELSE 1 END')
                      ->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        $productsData = $products->getCollection()->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'product_code' => $product->product_code,
                'short_description' => $product->short_description,
                'price' => $product->price,
                'sales_price' => $product->sales_price,
                'final_price' => $product->final_price,
                'has_discount' => $product->hasDiscount(),
                'discount_percentage' => $product->discount_percentage,
                'stock' => $product->stock,
                'category' => $product->category->name,
                'category_id' => $product->category_id,
                'main_image_url' => $product->main_image_url,
                'slug' => Str::slug($product->name), // CHANGED FROM str_slug() to Str::slug()
                'is_featured' => $product->stock > 10,
                'is_new' => $product->created_at->isAfter(now()->subDays(30)),
                'rating' => 4.8,
                'reviews_count' => rand(50, 300)
            ];
        });

        return response()->json([
            'success' => true,
            'products' => $productsData,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem()
            ]
        ]);
    }
}