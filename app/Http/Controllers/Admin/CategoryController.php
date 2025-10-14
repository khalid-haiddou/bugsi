<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Show categories page
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $totalCategories = Category::count();
        $totalProducts = Category::sum('products_count');
        $topCategory = Category::orderBy('products_count', 'desc')->first();

        return view('admin.categories', compact('categories', 'totalCategories', 'totalProducts', 'topCategory'));
    }

    // Get all categories (AJAX)
    public function getCategories()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    // Store new category
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'icon' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'اسم الفئة مطلوب',
            'name.unique' => 'اسم الفئة موجود بالفعل',
            'icon.required' => 'يرجى اختيار أيقونة للفئة',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2MB'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $categoryData = [
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
        ];

        // Handle image upload (optional)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('categories', $imageName, 'public');
            $categoryData['image'] = $imagePath;
        }

        $category = Category::create($categoryData);

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة الفئة بنجاح',
            'category' => $category
        ]);
    }

    // Get single category
    public function show($id)
    {
        $category = Category::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
            'icon' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'اسم الفئة مطلوب',
            'name.unique' => 'اسم الفئة موجود بالفعل',
            'icon.required' => 'يرجى اختيار أيقونة للفئة',
            'image.image' => 'الملف يجب أن يكون صورة',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2MB'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $categoryData = [
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('categories', $imageName, 'public');
            $categoryData['image'] = $imagePath;
        }

        $category->update($categoryData);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث الفئة بنجاح',
            'category' => $category
        ]);
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete image if exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم حذف الفئة بنجاح'
        ]);
    }
}