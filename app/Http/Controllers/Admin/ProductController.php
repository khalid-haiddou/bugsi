<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Apply filters
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('stock') && $request->stock) {
            switch ($request->stock) {
                case 'in-stock':
                    $query->where('stock', '>', 10);
                    break;
                case 'low-stock':
                    $query->where('stock', '>', 0)->where('stock', '<=', 10);
                    break;
                case 'out-of-stock':
                    $query->where('stock', 0);
                    break;
            }
        }

        // Apply sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12);
        $categories = Category::orderBy('name')->get();

        // Calculate stats
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 'active')->count();
        $lowStockProducts = Product::where('stock', '>', 0)->where('stock', '<=', 10)->count();
        $outOfStockProducts = Product::where('stock', 0)->count();

        // Transform products data to include computed attributes
        $productsData = $products->getCollection()->map(function($product) {
            return [
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
                'status' => $product->status,
                'category' => $product->category->name,
                'category_id' => $product->category_id,
                'main_image_url' => $product->main_image_url,
                'gallery_image_urls' => $product->gallery_image_urls,
                'stock_status' => $product->stock_status
            ];
        });

        return view('admin.products', compact(
            'products', 
            'categories', 
            'totalProducts', 
            'activeProducts', 
            'lowStockProducts', 
            'outOfStockProducts',
            'productsData'
        ));
    }

    public function getProducts(Request $request)
    {
        $query = Product::with('category');

        // Apply filters
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('stock') && $request->stock) {
            switch ($request->stock) {
                case 'in-stock':
                    $query->where('stock', '>', 10);
                    break;
                case 'low-stock':
                    $query->where('stock', '>', 0)->where('stock', '<=', 10);
                    break;
                case 'out-of-stock':
                    $query->where('stock', 0);
                    break;
            }
        }

        $products = $query->orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'products' => $products->map(function($product) {
                return [
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
                    'status' => $product->status,
                    'category' => $product->category->name,
                    'category_id' => $product->category_id,
                    'main_image_url' => $product->main_image_url,
                    'stock_status' => $product->stock_status
                ];
            })
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'product_code' => 'required|string|max:50|unique:products,product_code',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sales_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'category_id' => 'required|exists:categories,id',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_info.size' => 'nullable|string|max:100',
            'additional_info.ingredients' => 'nullable|string|max:500',
            'additional_info.usage' => 'nullable|string|max:200',
            'additional_info.expiry' => 'nullable|string|max:100',
            'additional_info.storage' => 'nullable|string|max:200',
        ], [
            'name.required' => 'اسم المنتج مطلوب',
            'product_code.required' => 'رمز المنتج مطلوب',
            'product_code.unique' => 'رمز المنتج موجود بالفعل',
            'short_description.max' => 'الوصف المختصر يجب ألا يتجاوز 500 حرف',
            'price.required' => 'سعر المنتج مطلوب',
            'price.numeric' => 'السعر يجب أن يكون رقماً',
            'sales_price.numeric' => 'سعر التخفيض يجب أن يكون رقماً',
            'sales_price.lt' => 'سعر التخفيض يجب أن يكون أقل من السعر الأساسي',
            'stock.required' => 'كمية المخزون مطلوبة',
            'stock.integer' => 'المخزون يجب أن يكون رقماً صحيحاً',
            'category_id.required' => 'يرجى اختيار فئة المنتج',
            'category_id.exists' => 'الفئة المختارة غير موجودة',
            'main_image.required' => 'الصورة الرئيسية مطلوبة',
            'main_image.image' => 'الملف يجب أن يكون صورة',
            'main_image.max' => 'حجم الصورة يجب ألا يتجاوز 2MB'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle main image upload
        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $extension = $mainImage->getClientOriginalExtension();
            $mainImageName = time() . '_main_' . uniqid() . '.' . $extension;
            $mainImagePath = $mainImage->storeAs('products', $mainImageName, 'public');
        }

        // Handle gallery images upload
        $galleryImagePaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $galleryImage) {
                $extension = $galleryImage->getClientOriginalExtension();
                $galleryImageName = time() . '_gallery_' . $index . '_' . uniqid() . '.' . $extension;
                $galleryImagePath = $galleryImage->storeAs('products', $galleryImageName, 'public');
                $galleryImagePaths[] = $galleryImagePath;
            }
        }

        // Prepare additional info
        $additionalInfo = null;
        if ($request->has('additional_info')) {
            $additionalInfo = array_filter($request->additional_info, function($value) {
                return !empty($value);
            });
        }

        $product = Product::create([
            'name' => $request->name,
            'product_code' => $request->product_code,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'tags' => $request->tags,
            'additional_info' => $additionalInfo,
            'price' => $request->price,
            'sales_price' => $request->sales_price,
            'stock' => $request->stock,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'main_image' => $mainImagePath,
            'gallery_images' => $galleryImagePaths
        ]);

        // Update category products count
        $product->category->updateProductsCount();

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة المنتج بنجاح',
            'product' => $product->load('category')
        ]);
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'product_code' => $product->product_code,
                'description' => $product->description,
                'short_description' => $product->short_description,
                'tags' => $product->tags,
                'additional_info' => $product->additional_info,
                'price' => $product->price,
                'sales_price' => $product->sales_price,
                'stock' => $product->stock,
                'status' => $product->status,
                'category_id' => $product->category_id,
                'category' => $product->category->name,
                'main_image_url' => $product->main_image_url,
                'gallery_image_urls' => $product->gallery_image_urls
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'product_code' => 'required|string|max:50|unique:products,product_code,' . $id,
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'tags' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sales_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'category_id' => 'required|exists:categories,id',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_info.size' => 'nullable|string|max:100',
            'additional_info.ingredients' => 'nullable|string|max:500',
            'additional_info.usage' => 'nullable|string|max:200',
            'additional_info.expiry' => 'nullable|string|max:100',
            'additional_info.storage' => 'nullable|string|max:200',
        ], [
            'name.required' => 'اسم المنتج مطلوب',
            'product_code.required' => 'رمز المنتج مطلوب',
            'product_code.unique' => 'رمز المنتج موجود بالفعل',
            'price.required' => 'سعر المنتج مطلوب',
            'sales_price.lt' => 'سعر التخفيض يجب أن يكون أقل من السعر الأساسي',
            'stock.required' => 'كمية المخزون مطلوبة',
            'category_id.required' => 'يرجى اختيار فئة المنتج'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Prepare additional info
        $additionalInfo = $product->additional_info;
        if ($request->has('additional_info')) {
            $additionalInfo = array_filter($request->additional_info, function($value) {
                return !empty($value);
            });
        }

        $productData = [
            'name' => $request->name,
            'product_code' => $request->product_code,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'tags' => $request->tags,
            'additional_info' => $additionalInfo,
            'price' => $request->price,
            'sales_price' => $request->sales_price,
            'stock' => $request->stock,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ];

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            if ($product->main_image && file_exists(storage_path('app/public/' . $product->main_image))) {
                Storage::disk('public')->delete($product->main_image);
            }

            $mainImage = $request->file('main_image');
            $extension = $mainImage->getClientOriginalExtension();
            $mainImageName = time() . '_main_' . uniqid() . '.' . $extension;
            $mainImagePath = $mainImage->storeAs('products', $mainImageName, 'public');
            $productData['main_image'] = $mainImagePath;
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            if ($product->gallery_images) {
                foreach ($product->gallery_images as $oldImage) {
                    if (file_exists(storage_path('app/public/' . $oldImage))) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }

            $galleryImagePaths = [];
            foreach ($request->file('gallery_images') as $index => $galleryImage) {
                $extension = $galleryImage->getClientOriginalExtension();
                $galleryImageName = time() . '_gallery_' . $index . '_' . uniqid() . '.' . $extension;
                $galleryImagePath = $galleryImage->storeAs('products', $galleryImageName, 'public');
                $galleryImagePaths[] = $galleryImagePath;
            }
            $productData['gallery_images'] = $galleryImagePaths;
        }

        $oldCategoryId = $product->category_id;
        $product->update($productData);

        if ($oldCategoryId !== $product->category_id) {
            Category::find($oldCategoryId)->updateProductsCount();
            $product->category->updateProductsCount();
        }

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث المنتج بنجاح',
            'product' => $product->load('category')
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->main_image && file_exists(storage_path('app/public/' . $product->main_image))) {
            Storage::disk('public')->delete($product->main_image);
        }

        if ($product->gallery_images) {
            foreach ($product->gallery_images as $image) {
                if (file_exists(storage_path('app/public/' . $image))) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $category = $product->category;
        $product->delete();
        $category->updateProductsCount();

        return response()->json([
            'success' => true,
            'message' => 'تم حذف المنتج بنجاح'
        ]);
    }
}