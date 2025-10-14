<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="المتجر - تسوق منتجات Bugsi الصحية الطبيعية">
    <title>المتجر - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>
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
                <!-- Main Content -->
                <main class="main-content">
                    <!-- Toolbar -->
                    <div class="toolbar">
                        <div class="results-count">
                            عرض <strong id="productCount">9</strong> منتج
                        </div>
                        <div class="toolbar-right">
                            <div class="view-toggle">
                                <button class="view-btn active" id="gridView" title="شبكة">⊞</button>
                                <button class="view-btn" id="listView" title="قائمة">☰</button>
                            </div>
                            <select class="sort-select" id="sortSelect">
                                <option value="featured">الأكثر مبيعاً</option>
                                <option value="newest">الأحدث</option>
                                <option value="price-low">السعر: من الأقل للأعلى</option>
                                <option value="price-high">السعر: من الأعلى للأقل</option>
                                <option value="name">الاسم: أ-ي</option>
                            </select>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="products-grid" id="productsGrid">
                        <!-- Product 1 -->
                        <div class="product-card fade-in" data-category="mms" data-price="150">
                            <span class="product-badge bestseller">الأكثر مبيعاً</span>
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x280/0e9eff/ffffff?text=MMS" alt="MMS">
                                <div class="product-overlay">
                                    <button class="quick-view-btn">عرض سريع</button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-category">MMS</div>
                                <div class="product-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="review-count">(127)</span>
                                </div>
                                <h3>MMS - محلول معدني معجزة</h3>
                                <p>حل صحي طبيعي 100% للعافية اليومية</p>
                                <div class="product-footer">
                                    <div class="price-wrapper">
                                        <span class="old-price">200 dhs</span>
                                        <span class="price">150 dhs</span>
                                    </div>
                                    <button class="add-to-cart-btn">أضف للسلة</button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 2 -->
                        <div class="product-card fade-in" data-category="cds" data-price="220">
                            <span class="product-badge new">جديد</span>
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x280/00d2d3/ffffff?text=CDS" alt="CDS">
                                <div class="product-overlay">
                                    <button class="quick-view-btn">عرض سريع</button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-category">CDS</div>
                                <div class="product-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="review-count">(89)</span>
                                </div>
                                <h3>CDS - محلول الكلور المركز</h3>
                                <p>تركيبة فريدة لدعم الصحة العامة</p>
                                <div class="product-footer">
                                    <div class="price-wrapper">
                                        <span class="price">220 dhs</span>
                                    </div>
                                    <button class="add-to-cart-btn">أضف للسلة</button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 3 -->
                        <div class="product-card fade-in" data-category="dmso" data-price="180">
                            <span class="product-badge sale">خصم 30%</span>
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x280/ff6348/ffffff?text=DMSO" alt="DMSO">
                                <div class="product-overlay">
                                    <button class="quick-view-btn">عرض سريع</button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-category">DMSO</div>
                                <div class="product-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="review-count">(215)</span>
                                </div>
                                <h3>DMSO - ديميثيل سلفوكسيد</h3>
                                <p>حل طبيعي لتعزيز المناعة</p>
                                <div class="product-footer">
                                    <div class="price-wrapper">
                                        <span class="old-price">260 dhs</span>
                                        <span class="price">180 dhs</span>
                                    </div>
                                    <button class="add-to-cart-btn">أضف للسلة</button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 4 -->
                        <div class="product-card fade-in" data-category="zeolite" data-price="295">
                            <span class="product-badge bestseller">الأكثر مبيعاً</span>
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x280/0e9eff/ffffff?text=Zeolite" alt="Zeolite">
                                <div class="product-overlay">
                                    <button class="quick-view-btn">عرض سريع</button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-category">ZEOLITE</div>
                                <div class="product-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="review-count">(342)</span>
                                </div>
                                <h3>Zeolite - زيوليت طبيعي</h3>
                                <p>منتج فريد للعناية الصحية الشاملة</p>
                                <div class="product-footer">
                                    <div class="price-wrapper">
                                        <span class="price">295 dhs</span>
                                    </div>
                                    <button class="add-to-cart-btn">أضف للسلة</button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 5 -->
                        <div class="product-card fade-in" data-category="zafarane" data-price="350">
                            <span class="product-badge new">جديد</span>
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x280/ffd700/ffffff?text=Saffron" alt="زعفران">
                                <div class="product-overlay">
                                    <button class="quick-view-btn">عرض سريع</button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-category">زعفران</div>
                                <div class="product-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="review-count">(178)</span>
                                </div>
                                <h3>زعفران طبيعي فاخر</h3>
                                <p>زعفران عضوي 100% لصحة مثالية</p>
                                <div class="product-footer">
                                    <div class="price-wrapper">
                                        <span class="price">350 dhs</span>
                                    </div>
                                    <button class="add-to-cart-btn">أضف للسلة</button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 6 -->
                        <div class="product-card fade-in" data-category="mms" data-price="340">
                            <span class="product-badge sale">خصم 15%</span>
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x280/0e9eff/ffffff?text=MMS+Kit" alt="طقم MMS">
                                <div class="product-overlay">
                                    <button class="quick-view-btn">عرض سريع</button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-category">MMS</div>
                                <div class="product-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="review-count">(256)</span>
                                </div>
                                <h3>طقم MMS كامل</h3>
                                <p>طقم شامل للاستخدام اليومي</p>
                                <div class="product-footer">
                                    <div class="price-wrapper">
                                        <span class="old-price">400 dhs</span>
                                        <span class="price">340 dhs</span>
                                    </div>
                                    <button class="add-to-cart-btn">أضف للسلة</button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 7 -->
                        <div class="product-card fade-in" data-category="cds" data-price="280">
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x280/00d2d3/ffffff?text=CDS+Large" alt="CDS كبير">
                                <div class="product-overlay">
                                    <button class="quick-view-btn">عرض سريع</button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-category">CDS</div>
                                <div class="product-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="review-count">(198)</span>
                                </div>
                                <h3>CDS - عبوة كبيرة</h3>
                                <p>محلول CDS بتركيز عالي</p>
                                <div class="product-footer">
                                    <div class="price-wrapper">
                                        <span class="price">280 dhs</span>
                                    </div>
                                    <button class="add-to-cart-btn">أضف للسلة</button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 8 -->
                        <div class="product-card fade-in" data-category="dmso" data-price="195">
                            <span class="product-badge bestseller">الأكثر مبيعاً</span>
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x280/ff6348/ffffff?text=DMSO+Gel" alt="DMSO جل">
                                <div class="product-overlay">
                                    <button class="quick-view-btn">عرض سريع</button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-category">DMSO</div>
                                <div class="product-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="review-count">(312)</span>
                                </div>
                                <h3>DMSO جل موضعي</h3>
                                <p>جل DMSO للاستخدام الخارجي</p>
                                <div class="product-footer">
                                    <div class="price-wrapper">
                                        <span class="price">195 dhs</span>
                                    </div>
                                    <button class="add-to-cart-btn">أضف للسلة</button>
                                </div>
                            </div>
                        </div>

                        <!-- Product 9 -->
                        <div class="product-card fade-in" data-category="mms" data-price="175">
                            <div class="product-image">
                                <img src="https://via.placeholder.com/300x280/0e9eff/ffffff?text=MMS+Small" alt="MMS صغير">
                                <div class="product-overlay">
                                    <button class="quick-view-btn">عرض سريع</button>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-category">MMS</div>
                                <div class="product-rating">
                                    <span class="stars">⭐⭐⭐⭐⭐</span>
                                    <span class="review-count">(145)</span>
                                </div>
                                <h3>MMS - عبوة صغيرة</h3>
                                <p>مثالي للمبتدئين</p>
                                <div class="product-footer">
                                    <div class="price-wrapper">
                                        <span class="price">175 dhs</span>
                                    </div>
                                    <button class="add-to-cart-btn">أضف للسلة</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <button class="pagination-btn" disabled>السابق</button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">التالي</button>
                    </div>
                </main>
            </div>
        </div>
    </section>


</body>
</html>