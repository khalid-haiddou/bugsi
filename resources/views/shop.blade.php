<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="المتجر - تسوق منتجات Bugsi الصحية الطبيعية">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>المتجر - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">
</head>
<body>
    @include('layouts.header')
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>متجر المنتجات الطبيعية</h1>
                <p>اكتشف مجموعتنا الكاملة من المنتجات الصحية عالية الجودة</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <ul class="breadcrumb-list">
                <li><a href="/">الرئيسية</a></li>
                <li>›</li>
                <li><span>المتجر</span></li>
            </ul>
        </div>
    </div>

    <!-- Shop Section -->
    <section class="shop-section">
        <div class="container">
            <div class="shop-container">
                <!-- Sidebar Filters -->
                <aside class="filters-sidebar">
                    <div class="filter-section">
                        <h3>البحث</h3>
                        <div class="search-box">
                            <input type="text" id="searchInput" placeholder="ابحث عن المنتجات..." value="{{ request('search') }}">
                            <button id="searchBtn">🔍</button>
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>الفئات</h3>
                        <div class="filter-options">
                            <label class="filter-option">
                                <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }}>
                                <span>جميع الفئات</span>
                            </label>
                            @foreach($categories as $category)
                            <label class="filter-option">
                                <input type="radio" name="category" value="{{ $category->id }}" {{ request('category') == $category->id ? 'checked' : '' }}>
                                <span>{{ $category->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3>السعر</h3>
                        <div class="price-range">
                            <div class="price-inputs">
                                <input type="number" id="minPrice" placeholder="من" value="{{ request('min_price') }}" min="0">
                                <span>-</span>
                                <input type="number" id="maxPrice" placeholder="إلى" value="{{ request('max_price') }}" min="0">
                            </div>
                            <button id="applyPriceFilter" class="apply-filter-btn">تطبيق</button>
                        </div>
                    </div>
                </aside>

                <!-- Main Content -->
                <main class="main-content">
                    <!-- Toolbar -->
                    <div class="toolbar">
                        <div class="results-count">
                            عرض <strong id="productCount">{{ $products->total() }}</strong> منتج
                        </div>
                        <div class="toolbar-right">
                            <div class="view-toggle">
                                <button class="view-btn active" id="gridView" title="شبكة">⊞</button>
                                <button class="view-btn" id="listView" title="قائمة">☰</button>
                            </div>
                            <select class="sort-select" id="sortSelect">
                                <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>الأكثر مبيعاً</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>الأحدث</option>
                                <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>السعر: من الأقل للأعلى</option>
                                <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>السعر: من الأعلى للأقل</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>الاسم: أ-ي</option>
                            </select>
                        </div>
                    </div>

                    <!-- Loading State -->
                    <div id="loadingState" class="loading-state" style="display: none;">
                        <div class="loading-spinner"></div>
                        <p>جاري تحميل المنتجات...</p>
                    </div>

                    <!-- Products Grid -->
                    <div class="products-grid" id="productsGrid">
                        @forelse($productsData as $product)
                        <div class="product-card fade-in" data-product-id="{{ $product['id'] }}">
                            @if($product['has_discount'])
                                <span class="product-badge sale">خصم {{ $product['discount_percentage'] }}%</span>
                            @elseif($product['is_new'])
                                <span class="product-badge new">جديد</span>
                            @elseif($product['is_featured'])
                                <span class="product-badge bestseller">الأكثر مبيعاً</span>
                            @endif
                            
                            <div class="product-image">
                                <img src="{{ $product['main_image_url'] ?: 'https://via.placeholder.com/300x280/0e9eff/ffffff?text=' . urlencode($product['name']) }}" 
                                     alt="{{ $product['name'] }}"
                                     loading="lazy">
                                <div class="product-overlay">
                                    <button class="quick-view-btn" data-product-id="{{ $product['id'] }}">عرض سريع</button>
                                </div>
                            </div>
                            
                            <div class="product-info">
                                <div class="product-category">{{ $product['category'] }}</div>
                                <div class="product-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="review-count">({{ $product['reviews_count'] }})</span>
                                </div>
                                <h3>{{ $product['name'] }}</h3>
                                <p>{{ $product['short_description'] ?: 'منتج صحي طبيعي عالي الجودة' }}</p>
                                <div class="product-footer">
                                    <div class="price-wrapper">
                                        @if($product['has_discount'])
                                            <span class="old-price">{{ $product['price'] }} MAD</span>
                                            <span class="price">{{ $product['sales_price'] }} MAD</span>
                                        @else
                                            <span class="price">{{ $product['price'] }} MAD</span>
                                        @endif
                                    </div>
                                    <button class="add-to-cart-btn" data-product-id="{{ $product['id'] }}">
                                        @if($product['stock'] > 0)
                                            أضف للسلة
                                        @else
                                            نفذ من المخزون
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="empty-products">
                            <div class="empty-icon">📦</div>
                            <h3>لم يتم العثور على منتجات</h3>
                            <p>جرب تغيير معايير البحث أو الفلاتر</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="pagination" id="paginationContainer">
                        {{ $products->links() }}
                    </div>
                </main>
            </div>
        </div>
    </section>

    <script>
        // Pass data to JavaScript
        window.shopData = {
            products: @json($productsData),
            currentPage: {{ $products->currentPage() }},
            lastPage: {{ $products->lastPage() }},
            total: {{ $products->total() }},
            perPage: {{ $products->perPage() }}
        };
    </script>
    <script src="{{ asset('assets/js/shop.js') }}"></script>
</body>
</html>