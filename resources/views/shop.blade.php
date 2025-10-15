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

            <!-- Products Grid -->
            <div class="products-grid" id="productsGrid">
                @forelse($productsData as $product)
                <div class="product-card fade-in clickable-card" 
                     data-product-id="{{ $product['id'] }}"
                     data-product-slug="{{ $product['slug'] }}"
                     onclick="navigateToProduct('{{ $product['slug'] }}')">
                     
                    @if($product['has_discount'])
                        <span class="product-badge sale">خصم {{ $product['discount_percentage'] }}%</span>
                    @elseif($product['is_new'])
                        <span class="product-badge new">جديد</span>
                    @elseif($product['is_featured'])
                        <span class="product-badge bestseller">الأكثر مبيعاً</span>
                    @endif
                    
                    <div class="product-image">
                        <img src="{{ $product['main_image_url'] ?: 'https://via.placeholder.com/300x300/0e9eff/ffffff?text=' . urlencode($product['name']) }}" 
                             alt="{{ $product['name'] }}"
                             loading="lazy">
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
                            <button class="add-to-cart-btn" 
                                    data-product-id="{{ $product['id'] }}"
                                    onclick="event.stopPropagation(); handleAddToCartClick(this);"
                                    {{ $product['stock'] <= 0 ? 'disabled' : '' }}>
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
                    <p>لا توجد منتجات متاحة حالياً</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pagination" id="paginationContainer">
                {{ $products->links() }}
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

        // Product navigation function
        function navigateToProduct(slug) {
            if (slug) {
                window.location.href = `/product/${slug}`;
            }
        }

        // Handle add to cart with event stopping
        function handleAddToCartClick(button) {
            if (button.disabled) return;
            
            const productId = button.dataset.productId;
            const originalText = button.textContent;
            const originalBackground = button.style.background;
            
            // Show success state
            button.textContent = '✓ تمت الإضافة';
            button.style.background = '#00c853';
            button.disabled = true;

            // Log for debugging (replace with actual cart logic)
            console.log('Add to cart - Product ID:', productId);
            
            // Show notification if function exists
            if (typeof showNotification === 'function') {
                showNotification('تم إضافة المنتج إلى السلة بنجاح!', 'success');
            }

            // Reset button after delay
            setTimeout(() => {
                button.textContent = originalText;
                button.style.background = originalBackground;
                button.disabled = false;
            }, 1500);
        }
    </script>
    <script src="{{ asset('assets/js/shop.js') }}"></script>
</body>
</html>