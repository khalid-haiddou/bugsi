<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $productData['short_description'] ?: $productData['name'] . ' - منتج صحي طبيعي من Bugsi' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $productData['name'] }} - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/single-product.css') }}">
</head>
<body>
    @include('layouts.header')
    
    <!-- Product Section -->
    <section class="product-section">
        <div class="container">
            <!-- Product Container -->
            <div class="product-container">
                <!-- Product Gallery -->
                <div class="product-gallery">
                    <div class="main-image">
                        @if($productData['has_discount'])
                            <span class="product-badge sale">خصم {{ $productData['discount_percentage'] }}%</span>
                        @elseif($productData['is_new'])
                            <span class="product-badge new">جديد</span>
                        @elseif($productData['is_featured'])
                            <span class="product-badge bestseller">الأكثر مبيعاً</span>
                        @endif
                        <img src="{{ $productData['main_image_url'] ?: 'https://via.placeholder.com/600x600/0e9eff/ffffff?text=' . urlencode($productData['name']) }}" 
                             alt="{{ $productData['name'] }}" 
                             id="mainImage">
                    </div>
                    <div class="thumbnail-list">
                        <!-- Main image thumbnail -->
                        <div class="thumbnail active" data-image="{{ $productData['main_image_url'] ?: 'https://via.placeholder.com/600x600/0e9eff/ffffff?text=' . urlencode($productData['name']) }}">
                            <img src="{{ $productData['main_image_url'] ?: 'https://via.placeholder.com/150x150/0e9eff/ffffff?text=1' }}" alt="الصورة الرئيسية">
                        </div>
                        
                        <!-- Gallery images -->
                        @if($productData['gallery_image_urls'] && count($productData['gallery_image_urls']) > 0)
                            @foreach($productData['gallery_image_urls'] as $index => $galleryImage)
                            <div class="thumbnail" data-image="{{ $galleryImage }}">
                                <img src="{{ $galleryImage }}" alt="صورة {{ $index + 2 }}">
                            </div>
                            @endforeach
                        @else
                            <!-- Placeholder thumbnails if no gallery images -->
                            <div class="thumbnail" data-image="https://via.placeholder.com/600x600/00d2d3/ffffff?text={{ urlencode($productData['name']) }}+2">
                                <img src="https://via.placeholder.com/150x150/00d2d3/ffffff?text=2" alt="صورة 2">
                            </div>
                            <div class="thumbnail" data-image="https://via.placeholder.com/600x600/0077cc/ffffff?text={{ urlencode($productData['name']) }}+3">
                                <img src="https://via.placeholder.com/150x150/0077cc/ffffff?text=3" alt="صورة 3">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="product-info">
                    <div class="product-category">{{ $productData['category'] }}</div>
                    <h1 class="product-title">{{ $productData['name'] }}</h1>
                    
                    <div class="product-rating">
                        <span class="stars">⭐⭐⭐⭐⭐</span>
                        <span class="rating-text">{{ $productData['rating'] }} (<span class="rating-count">{{ $productData['reviews_count'] }} تقييم</span>)</span>
                    </div>

                    <div class="product-price">
                        <div class="price-wrapper">
                            @if($productData['has_discount'])
                                <span class="current-price">{{ $productData['sales_price'] }} MAD</span>
                                <span class="old-price">{{ $productData['price'] }} MAD</span>
                                <span class="discount-badge">خصم {{ $productData['discount_percentage'] }}%</span>
                            @else
                                <span class="current-price">{{ $productData['price'] }} MAD</span>
                            @endif
                        </div>
                        <span class="stock-status">
                            @if($productData['stock'] > 0)
                                ✓ متوفر في المخزون ({{ $productData['stock'] }} قطعة)
                            @else
                                ❌ نفذ من المخزون
                            @endif
                        </span>
                    </div>

                    <p class="product-description">
                        {{ $productData['short_description'] ?: $productData['description'] ?: 'منتج صحي طبيعي عالي الجودة يتميز بتركيبته الفريدة والآمنة للاستخدام اليومي.' }}
                    </p>

                    @if($productData['tags'])
                    <div class="product-features">
                        <h3>الوسوم</h3>
                        <div class="tags-list">
                            @foreach(explode(',', $productData['tags']) as $tag)
                                <span class="tag">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="quantity-section">
                        <div class="quantity-label">الكمية:</div>
                        <div class="quantity-selector">
                            <div class="quantity-controls">
                                <button class="quantity-btn" id="decreaseQty">-</button>
                                <input type="number" class="quantity-input" id="quantity" value="1" min="1" max="{{ min($productData['stock'], 10) }}">
                                <button class="quantity-btn" id="increaseQty">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="product-actions">
                        <button class="btn btn-primary" id="addToCart" data-product-id="{{ $productData['id'] }}" {{ $productData['stock'] <= 0 ? 'disabled' : '' }}>
                            <span>🛒</span>
                            @if($productData['stock'] > 0)
                                أضف إلى السلة
                            @else
                                نفذ من المخزون
                            @endif
                        </button>
                        <button class="btn btn-secondary" id="buyNow" {{ $productData['stock'] <= 0 ? 'disabled' : '' }}>
                            اشتر الآن
                        </button>
                    </div>

                    <div class="product-meta">
                        @if($productData['product_code'])
                        <div class="meta-item">
                            <span class="meta-label">رمز المنتج:</span>
                            <span class="meta-value">{{ $productData['product_code'] }}</span>
                        </div>
                        @endif
                        <div class="meta-item">
                            <span class="meta-label">الفئة:</span>
                            <span class="meta-value">{{ $productData['category'] }}</span>
                        </div>
                        @if($productData['tags'])
                        <div class="meta-item">
                            <span class="meta-label">الوسوم:</span>
                            <span class="meta-value">{{ $productData['tags'] }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tabs Section -->
            <div class="tabs-section">
                <div class="tabs-nav">
                    <button class="tab-btn active" data-tab="description">الوصف</button>
                    <button class="tab-btn" data-tab="info">معلومات إضافية</button>
                    <button class="tab-btn" data-tab="reviews">التقييمات ({{ $productData['reviews_count'] }})</button>
                </div>

                <div class="tab-content active" id="description">
                    <h3>وصف المنتج</h3>
                    @if($productData['description'])
                        {!! nl2br(e($productData['description'])) !!}
                    @else
                        <p>{{ $productData['name'] }} هو منتج صحي طبيعي فريد من نوعه، يتميز بجودته العالية وفعاليته الممتازة.</p>
                        <p>يستخدم هذا المنتج على نطاق واسع لدعم الصحة العامة وتعزيز وظائف الجسم الطبيعية.</p>
                        <p>نحن في Bugsi نضمن لك الحصول على منتج أصلي ومعتمد، مع التزامنا الكامل بتوفير أعلى معايير الجودة والخدمة.</p>
                    @endif
                </div>

                <div class="tab-content" id="info">
                    <h3>معلومات إضافية</h3>
                    @if($productData['additional_info'] && count($productData['additional_info']) > 0)
                        <table style="width: 100%; border-collapse: collapse;">
                            @if(isset($productData['additional_info']['size']) && $productData['additional_info']['size'])
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 15px 0; font-weight: 700;">الحجم:</td>
                                <td style="padding: 15px 0;">{{ $productData['additional_info']['size'] }}</td>
                            </tr>
                            @endif
                            @if(isset($productData['additional_info']['ingredients']) && $productData['additional_info']['ingredients'])
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 15px 0; font-weight: 700;">المكونات:</td>
                                <td style="padding: 15px 0;">{{ $productData['additional_info']['ingredients'] }}</td>
                            </tr>
                            @endif
                            @if(isset($productData['additional_info']['usage']) && $productData['additional_info']['usage'])
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 15px 0; font-weight: 700;">الاستخدام:</td>
                                <td style="padding: 15px 0;">{{ $productData['additional_info']['usage'] }}</td>
                            </tr>
                            @endif
                            @if(isset($productData['additional_info']['expiry']) && $productData['additional_info']['expiry'])
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 15px 0; font-weight: 700;">مدة الصلاحية:</td>
                                <td style="padding: 15px 0;">{{ $productData['additional_info']['expiry'] }}</td>
                            </tr>
                            @endif
                            @if(isset($productData['additional_info']['storage']) && $productData['additional_info']['storage'])
                            <tr>
                                <td style="padding: 15px 0; font-weight: 700;">التخزين:</td>
                                <td style="padding: 15px 0;">{{ $productData['additional_info']['storage'] }}</td>
                            </tr>
                            @endif
                        </table>
                    @else
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 15px 0; font-weight: 700;">المنتج:</td>
                                <td style="padding: 15px 0;">{{ $productData['name'] }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 15px 0; font-weight: 700;">الفئة:</td>
                                <td style="padding: 15px 0;">{{ $productData['category'] }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 15px 0; font-weight: 700;">الحالة:</td>
                                <td style="padding: 15px 0;">منتج طبيعي عالي الجودة</td>
                            </tr>
                        </table>
                    @endif
                </div>

                <div class="tab-content" id="reviews">
                    <h3>تقييمات العملاء</h3>
                    
                    <div class="reviews-summary">
                        <div class="overall-rating">
                            <div class="rating-number">{{ $productData['rating'] }}</div>
                            <div class="stars" style="font-size: 24px; margin-bottom: 10px;">⭐⭐⭐⭐⭐</div>
                            <div style="color: var(--text-gray); font-size: 14px;">{{ $productData['reviews_count'] }} تقييم</div>
                        </div>

                        <div class="rating-bars">
                            <div class="rating-bar-item">
                                <span class="bar-label">5 نجوم</span>
                                <div class="bar-container">
                                    <div class="bar-fill" style="width: 85%"></div>
                                </div>
                                <span class="bar-count">{{ intval($productData['reviews_count'] * 0.85) }}</span>
                            </div>
                            <div class="rating-bar-item">
                                <span class="bar-label">4 نجوم</span>
                                <div class="bar-container">
                                    <div class="bar-fill" style="width: 10%"></div>
                                </div>
                                <span class="bar-count">{{ intval($productData['reviews_count'] * 0.10) }}</span>
                            </div>
                            <div class="rating-bar-item">
                                <span class="bar-label">3 نجوم</span>
                                <div class="bar-container">
                                    <div class="bar-fill" style="width: 3%"></div>
                                </div>
                                <span class="bar-count">{{ intval($productData['reviews_count'] * 0.03) }}</span>
                            </div>
                            <div class="rating-bar-item">
                                <span class="bar-label">2 نجوم</span>
                                <div class="bar-container">
                                    <div class="bar-fill" style="width: 1%"></div>
                                </div>
                                <span class="bar-count">{{ intval($productData['reviews_count'] * 0.01) }}</span>
                            </div>
                            <div class="rating-bar-item">
                                <span class="bar-label">1 نجمة</span>
                                <div class="bar-container">
                                    <div class="bar-fill" style="width: 1%"></div>
                                </div>
                                <span class="bar-count">{{ intval($productData['reviews_count'] * 0.01) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sample reviews -->
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">أ</div>
                                <div>
                                    <div class="reviewer-name">أحمد المنصوري</div>
                                    <div class="stars" style="font-size: 16px;">⭐⭐⭐⭐⭐</div>
                                </div>
                            </div>
                            <div class="review-date">منذ أسبوع</div>
                        </div>
                        <p class="review-text">منتج ممتاز وفعال جداً! لاحظت تحسناً كبيراً في صحتي العامة بعد استخدامه. الجودة عالية والخدمة ممتازة. أنصح به بشدة!</p>
                    </div>

                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">ف</div>
                                <div>
                                    <div class="reviewer-name">فاطمة الزهراء</div>
                                    <div class="stars" style="font-size: 16px;">⭐⭐⭐⭐⭐</div>
                                </div>
                            </div>
                            <div class="review-date">منذ أسبوعين</div>
                        </div>
                        <p class="review-text">راضية جداً عن المنتج! الشحن كان سريع والمنتج أصلي 100%. سأطلبه مرة أخرى بالتأكيد.</p>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts && count($relatedProducts) > 0)
            <div class="related-section">
                <div class="section-header">
                    <h2>منتجات ذات صلة</h2>
                    <p>قد تعجبك أيضاً</p>
                </div>

                <div class="products-grid">
                    @foreach($relatedProducts as $relatedProduct)
                    <div class="product-card" onclick="window.location.href='/product/{{ $relatedProduct['slug'] }}'">
                        <div class="product-image">
                            <img src="{{ $relatedProduct['main_image_url'] ?: 'https://via.placeholder.com/300x200/0e9eff/ffffff?text=' . urlencode($relatedProduct['name']) }}" 
                                 alt="{{ $relatedProduct['name'] }}">
                        </div>
                        <div class="product-card-info">
                            <h3>{{ $relatedProduct['name'] }}</h3>
                            <div class="product-card-price">
                                @if($relatedProduct['has_discount'])
                                    <span class="old-price-small">{{ $relatedProduct['price'] }} MAD</span>
                                    <span class="current-price-small">{{ $relatedProduct['sales_price'] }} MAD</span>
                                @else
                                    {{ $relatedProduct['price'] }} MAD
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

    <script>
        // Pass product data to JavaScript
        window.productData = @json($productData);
    </script>
    <!-- Load cart manager first, then single product script -->
    <script src="{{ asset('assets/js/cart-manager.js') }}"></script>
    <script src="{{ asset('assets/js/single-product.js') }}"></script>
</body>
</html>