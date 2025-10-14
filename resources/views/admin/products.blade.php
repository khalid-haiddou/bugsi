<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المنتجات - Bugsi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/products.css') }}">
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

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon blue">🛍️</div>
                    </div>
                    <div class="stat-label">إجمالي المنتجات</div>
                    <div class="stat-value">156</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon green">✅</div>
                    </div>
                    <div class="stat-label">منتجات متاحة</div>
                    <div class="stat-value">142</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon orange">⚠️</div>
                    </div>
                    <div class="stat-label">مخزون منخفض</div>
                    <div class="stat-value">8</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon red">❌</div>
                    </div>
                    <div class="stat-label">نفذ من المخزون</div>
                    <div class="stat-value">6</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-card">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">الفئة</label>
                        <select class="filter-select" id="categoryFilter">
                            <option value="">جميع الفئات</option>
                            <option value="health">الصحة والعافية</option>
                            <option value="supplements">المكملات الغذائية</option>
                            <option value="beauty">العناية والجمال</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">الحالة</label>
                        <select class="filter-select" id="statusFilter">
                            <option value="">جميع الحالات</option>
                            <option value="active">نشط</option>
                            <option value="inactive">غير نشط</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">المخزون</label>
                        <select class="filter-select" id="stockFilter">
                            <option value="">الكل</option>
                            <option value="in-stock">متوفر</option>
                            <option value="low-stock">منخفض</option>
                            <option value="out-of-stock">نفذ</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">الترتيب</label>
                        <select class="filter-select" id="sortFilter">
                            <option value="newest">الأحدث</option>
                            <option value="oldest">الأقدم</option>
                            <option value="name">الاسم</option>
                            <option value="price-low">السعر: منخفض - مرتفع</option>
                            <option value="price-high">السعر: مرتفع - منخفض</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="products-card">
                <div class="card-header">
                    <h2 class="card-title">قائمة المنتجات</h2>
                    <div class="view-toggle">
                        <button class="view-btn active" onclick="toggleView('grid')" title="عرض الشبكة">
                            ⊞
                        </button>
                        <button class="view-btn" onclick="toggleView('table')" title="عرض الجدول">
                            ☰
                        </button>
                    </div>
                </div>

                <!-- Grid View -->
                <div class="products-grid" id="productsGrid">
                    <!-- Products will be inserted here by JavaScript -->
                </div>

                <!-- Table View -->
                <div class="products-table" id="productsTable">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>الفئة</th>
                                    <th>السعر</th>
                                    <th>المخزون</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody id="productsTableBody">
                                <!-- Table rows will be inserted here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination-info">
                        عرض <strong>1-12</strong> من <strong>156</strong> منتج
                    </div>
                    <div class="pagination-buttons">
                        <button class="page-btn" disabled>«</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">5</button>
                        <button class="page-btn">»</button>
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

            <form id="productForm">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label class="form-label">اسم المنتج *</label>
                        <input type="text" class="form-input" id="productName" placeholder="مثال: محلول معدني معجزة" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الفئة *</label>
                        <select class="form-select" id="productCategory" required>
                            <option value="">اختر الفئة</option>
                            <option value="health">الصحة والعافية</option>
                            <option value="supplements">المكملات الغذائية</option>
                            <option value="beauty">العناية والجمال</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">السعر (dhs) *</label>
                        <input type="number" class="form-input" id="productPrice" placeholder="150" min="0" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">كمية المخزون *</label>
                        <input type="number" class="form-input" id="productStock" placeholder="100" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الحالة</label>
                        <select class="form-select" id="productStatus">
                            <option value="active">نشط</option>
                            <option value="inactive">غير نشط</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">الوصف</label>
                        <textarea class="form-textarea" id="productDescription" placeholder="وصف تفصيلي للمنتج..."></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">صورة المنتج الرئيسية *</label>
                        <div class="image-upload" onclick="document.getElementById('productMainImage').click()">
                            <div class="image-upload-icon">📷</div>
                            <div class="image-upload-text">انقر لرفع الصورة الرئيسية للمنتج</div>
                        </div>
                        <input type="file" id="productMainImage" accept="image/*" style="display: none;" onchange="previewMainImage(event)">
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
                        <input type="file" id="productGallery" accept="image/*" multiple style="display: none;" onchange="previewGalleryImages(event)">
                        <div class="gallery-grid" id="galleryGrid"></div>
                        <div id="galleryCount"></div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeProductModal()">
                        إلغاء
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span>💾</span>
                        حفظ المنتج
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/admin/products.js') }}"></script>
</body>
</html>