<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إدارة المنتجات - Bugsi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/products.css') }}">
</head>
<body>
    @include('layouts.sidebar') 

    <main class="main-content">
        @include('layouts.admin-header')

        <div class="content">
            <div class="page-header">
                <div class="page-title-section">
                    <h1 class="page-title">إدارة المنتجات</h1>
                    <p class="page-subtitle">عرض وإدارة جميع المنتجات في المتجر</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-secondary" onclick="importProducts()">
                        <span>📥</span>
                        استيراد
                    </button>
                    <button class="btn btn-primary" onclick="openProductModal()">
                        <span>➕</span>
                        منتج جديد
                    </button>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon blue">🛍️</div>
                    </div>
                    <div class="stat-label">إجمالي المنتجات</div>
                    <div class="stat-value">{{ $totalProducts }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon green">✅</div>
                    </div>
                    <div class="stat-label">منتجات متاحة</div>
                    <div class="stat-value">{{ $activeProducts }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon orange">⚠️</div>
                    </div>
                    <div class="stat-label">مخزون منخفض</div>
                    <div class="stat-value">{{ $lowStockProducts }}</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon red">❌</div>
                    </div>
                    <div class="stat-label">نفذ من المخزون</div>
                    <div class="stat-value">{{ $outOfStockProducts }}</div>
                </div>
            </div>

            <div class="filters-card">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">الفئة</label>
                        <select class="filter-select" id="categoryFilter" onchange="applyFilters()">
                            <option value="">جميع الفئات</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">الحالة</label>
                        <select class="filter-select" id="statusFilter" onchange="applyFilters()">
                            <option value="">جميع الحالات</option>
                            <option value="active">نشط</option>
                            <option value="inactive">غير نشط</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">المخزون</label>
                        <select class="filter-select" id="stockFilter" onchange="applyFilters()">
                            <option value="">الكل</option>
                            <option value="in-stock">متوفر</option>
                            <option value="low-stock">منخفض</option>
                            <option value="out-of-stock">نفذ</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">الترتيب</label>
                        <select class="filter-select" id="sortFilter" onchange="applyFilters()">
                            <option value="newest">الأحدث</option>
                            <option value="oldest">الأقدم</option>
                            <option value="name">الاسم</option>
                            <option value="price-low">السعر: منخفض - مرتفع</option>
                            <option value="price-high">السعر: مرتفع - منخفض</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="products-card">
                <div class="card-header">
                    <h2 class="card-title">قائمة المنتجات</h2>
                    <div class="view-toggle">
                        <button class="view-btn active" onclick="toggleView('grid')" title="عرض الشبكة">⊞</button>
                        <button class="view-btn" onclick="toggleView('table')" title="عرض الجدول">☰</button>
                    </div>
                </div>

                <div class="products-grid" id="productsGrid"></div>

                <div class="products-table" id="productsTable">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>رمز المنتج</th>
                                    <th>الفئة</th>
                                    <th>السعر</th>
                                    <th>المخزون</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody id="productsTableBody"></tbody>
                        </table>
                    </div>
                </div>

                <div class="pagination">
                    <div class="pagination-info">
                        عرض <strong>{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</strong> من <strong>{{ $products->total() }}</strong> منتج
                    </div>
                    <div class="pagination-buttons">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Product Modal -->
    <div class="modal" id="productModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">إضافة منتج جديد</h2>
                <button class="close-btn" onclick="closeProductModal()">×</button>
            </div>

            <form id="productForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="productId" name="product_id">
                <input type="hidden" id="methodField" name="_method">
                
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label class="form-label">اسم المنتج *</label>
                        <input type="text" class="form-input" id="productName" name="name" placeholder="مثال: محلول معدني معجزة" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">رمز المنتج *</label>
                        <input type="text" class="form-input" id="productCode" name="product_code" placeholder="مثال: MMS-001" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الفئة *</label>
                        <select class="form-select" id="productCategory" name="category_id" required>
                            <option value="">اختر الفئة</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">السعر الأساسي (MAD) *</label>
                        <input type="number" class="form-input" id="productPrice" name="price" placeholder="150" min="0" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">سعر التخفيض (MAD)</label>
                        <input type="number" class="form-input" id="productSalesPrice" name="sales_price" placeholder="120" min="0" step="0.01">
                        <small class="form-hint">اتركه فارغاً إذا لم يكن هناك تخفيض</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">كمية المخزون *</label>
                        <input type="number" class="form-input" id="productStock" name="stock" placeholder="100" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الحالة</label>
                        <select class="form-select" id="productStatus" name="status">
                            <option value="active">نشط</option>
                            <option value="inactive">غير نشط</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">الوصف المختصر</label>
                        <textarea class="form-textarea" id="productShortDescription" name="short_description" placeholder="وصف مختصر يظهر في صفحة المنتج..." rows="3"></textarea>
                        <small class="form-hint">حد أقصى 500 حرف</small>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">الوصف التفصيلي</label>
                        <textarea class="form-textarea" id="productDescription" name="description" placeholder="وصف تفصيلي للمنتج..." rows="5"></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">الوسوم</label>
                        <input type="text" class="form-input" id="productTags" name="tags" placeholder="مثال: طبيعي, صحة, مناعة">
                        <small class="form-hint">افصل بين الوسوم بفاصلة</small>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">معلومات إضافية</label>
                        <div class="additional-info-grid">
                            <div class="form-group">
                                <label class="form-label">الحجم</label>
                                <input type="text" class="form-input" id="productSize" name="additional_info[size]" placeholder="100 مل">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">الاستخدام</label>
                                <input type="text" class="form-input" id="productUsage" name="additional_info[usage]" placeholder="يومي">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">مدة الصلاحية</label>
                                <input type="text" class="form-input" id="productExpiry" name="additional_info[expiry]" placeholder="سنتان">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">المكونات</label>
                                <input type="text" class="form-input" id="productIngredients" name="additional_info[ingredients]" placeholder="مكونات طبيعية 100%">
                            </div>
                            
                            <div class="form-group full-width">
                                <label class="form-label">التخزين</label>
                                <input type="text" class="form-input" id="productStorage" name="additional_info[storage]" placeholder="يحفظ في مكان بارد وجاف">
                            </div>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">صورة المنتج الرئيسية *</label>
                        <div class="image-upload" onclick="document.getElementById('productMainImage').click()">
                            <div class="image-upload-icon">📷</div>
                            <div class="image-upload-text">انقر لرفع الصورة الرئيسية للمنتج</div>
                        </div>
                        <input type="file" id="productMainImage" name="main_image" accept="image/*" style="display: none;" onchange="previewMainImage(event)">
                        <div class="image-preview-container" id="mainImagePreview">
                            <img id="mainImageDisplay" class="main-image-preview">
                            <button type="button" class="remove-image-btn" onclick="removeMainImage()">×</button>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">معرض الصور (اختياري)</label>
                        <div class="gallery-upload" onclick="document.getElementById('productGallery').click()">
                            <div class="gallery-upload-icon">🖼️</div>
                            <div class="gallery-upload-text">انقر لرفع صور إضافية (يمكن اختيار عدة صور)</div>
                        </div>
                        <input type="file" id="productGallery" name="gallery_images[]" accept="image/*" multiple style="display: none;" onchange="previewGalleryImages(event)">
                        <div class="gallery-grid" id="galleryGrid"></div>
                        <div id="galleryCount"></div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeProductModal()">إلغاء</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span>💾</span>
                        حفظ المنتج
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.productsData = @json($productsData);
        window.categoriesData = @json($categories);
    </script>
    <script src="{{ asset('assets/js/admin/products.js') }}"></script>
</body>
</html>