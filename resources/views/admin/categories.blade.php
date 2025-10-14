<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إدارة الفئات - Bugsi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/categories.css') }}">
</head>
<body>
    <!-- Sidebar -->
    @include('layouts.sidebar') 

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        @include('layouts.admin-header') 

        <!-- Content -->
        <div class="content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-title-section">
                    <h1 class="page-title">إدارة الفئات</h1>
                    <p class="page-subtitle">تنظيم وإدارة فئات المنتجات في المتجر</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-primary" onclick="openCategoryModal()">
                        <span>➕</span>
                        فئة جديدة
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon blue">📂</div>
                    </div>
                    <div class="stat-label">إجمالي الفئات</div>
                    <div class="stat-value">{{ $totalCategories }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon green">🛍️</div>
                    </div>
                    <div class="stat-label">إجمالي المنتجات</div>
                    <div class="stat-value">{{ $totalProducts }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon orange">⭐</div>
                    </div>
                    <div class="stat-label">الفئة الأكثر مبيعاً</div>
                    <div class="stat-value" style="font-size: 18px;">
                        {{ $topCategory ? $topCategory->name : 'لا توجد بيانات' }}
                    </div>
                </div>
            </div>

            <!-- Categories Grid -->
            <div class="categories-card">
                <div class="card-header">
                    <h2 class="card-title">قائمة الفئات</h2>
                </div>

                <div class="categories-grid" id="categoriesGrid">
                    <!-- Categories will be inserted here by JavaScript -->
                </div>
            </div>
        </div>
    </main>

    <!-- Category Modal -->
    <div class="modal" id="categoryModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">إضافة فئة جديدة</h2>
                <button class="close-btn" onclick="closeCategoryModal()">×</button>
            </div>

            <form id="categoryForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="categoryId" name="category_id">
                <input type="hidden" id="methodField" name="_method">
                
                <div class="form-group">
                    <label class="form-label">اسم الفئة *</label>
                    <input type="text" class="form-input" id="categoryName" name="name" placeholder="مثال: الصحة والعافية" required>
                </div>

                <div class="form-group">
                    <label class="form-label">وصف الفئة</label>
                    <textarea class="form-textarea" id="categoryDescription" name="description" placeholder="وصف مختصر للفئة..."></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">اختر أيقونة الفئة *</label>
                    <div class="icon-selector" id="iconSelector">
                        <!-- Icons will be inserted here -->
                    </div>
                    <input type="hidden" id="selectedIcon" name="icon" value="" required>
                </div>

                <div class="form-group">
                    <label class="form-label">صورة الفئة (اختياري)</label>
                    <div class="image-upload" onclick="document.getElementById('categoryImage').click()">
                        <div class="image-upload-icon">📷</div>
                        <div class="image-upload-text">انقر لرفع صورة الفئة</div>
                    </div>
                    <input type="file" id="categoryImage" name="image" accept="image/*" style="display: none;" onchange="previewCategoryImage(event)">
                    <div class="image-preview-container" id="imagePreview">
                        <img id="imageDisplay" class="category-image-preview">
                        <button type="button" class="remove-image-btn" onclick="removeCategoryImage()">×</button>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeCategoryModal()">
                        إلغاء
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span>💾</span>
                        حفظ الفئة
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Pass categories data to JavaScript
        window.categoriesData = @json($categories);
    </script>
    <script src="{{ asset('assets/js/admin/categories.js') }}"></script>
</body>
</html>