<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bugsi - حلول صحية طبيعية للدكتور جيم همبل">
    <title>Bugsi - الحلول الصحية الطبيعية</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>رحلتك نحو الصحة الطبيعية تبدأ هنا</h1>
                    <p>اكتشف قوة الحلول الصحية الطبيعية من الدكتور جيم همبل. منتجات موثوقة، تعليم شامل، ومجتمع داعم لرحلتك نحو العافية المثالية.</p>
                    <div class="hero-buttons">
                        <a href="/shop" class="btn">تسوق الآن</a>
                        <a href="/about" class="btn btn-secondary">تعرف علينا</a>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="hero-image-placeholder">🌿</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">5000+</div>
                    <div class="stat-label">عميل راضٍ</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">منتج طبيعي</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">99%</div>
                    <div class="stat-label">نسبة الرضا</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">دعم العملاء</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">✨ مميز</span>
                <h2>المنتجات الأكثر مبيعاً</h2>
                <p>اكتشف أفضل منتجاتنا الصحية الطبيعية المختارة بعناية</p>
            </div>
            
            <!-- Category Filter -->
            <div class="category-filter">
                <button class="filter-btn active" data-category="all">جميع المنتجات</button>
                <button class="filter-btn" data-category="mms">MMS</button>
                <button class="filter-btn" data-category="cds">CDS</button>
                <button class="filter-btn" data-category="dmso">DMSO</button>
                <button class="filter-btn" data-category="zeolite">Zeolite</button>
                <button class="filter-btn" data-category="zafarane">زعفران</button>
            </div>

            <div class="products-grid">
                <div class="product-card" data-category="mms">
                    <span class="product-badge">الأكثر مبيعاً</span>
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300/0e9eff/ffffff?text=MMS+Product" alt="منتج MMS">
                        <div class="product-overlay">
                            <button class="quick-view-btn">عرض سريع</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-rating">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="review-count">(127 تقييم)</span>
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

                <div class="product-card" data-category="cds">
                    <span class="product-badge new">جديد</span>
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300/00d2d3/ffffff?text=CDS+Product" alt="منتج CDS">
                        <div class="product-overlay">
                            <button class="quick-view-btn">عرض سريع</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-rating">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="review-count">(89 تقييم)</span>
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

                <div class="product-card" data-category="dmso">
                    <span class="product-badge sale">خصم 30%</span>
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300/ff6348/ffffff?text=DMSO+Product" alt="منتج DMSO">
                        <div class="product-overlay">
                            <button class="quick-view-btn">عرض سريع</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-rating">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="review-count">(215 تقييم)</span>
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

                <div class="product-card" data-category="zeolite">
                    <span class="product-badge">الأكثر مبيعاً</span>
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300/0e9eff/ffffff?text=Zeolite" alt="منتج Zeolite">
                        <div class="product-overlay">
                            <button class="quick-view-btn">عرض سريع</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-rating">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="review-count">(342 تقييم)</span>
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

                <div class="product-card" data-category="zafarane">
                    <span class="product-badge new">جديد</span>
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300/ffd700/ffffff?text=Saffron" alt="زعفران">
                        <div class="product-overlay">
                            <button class="quick-view-btn">عرض سريع</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-rating">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="review-count">(178 تقييم)</span>
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

                <div class="product-card" data-category="mms">
                    <span class="product-badge sale">خصم 15%</span>
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300/0e9eff/ffffff?text=MMS+Kit" alt="طقم MMS">
                        <div class="product-overlay">
                            <button class="quick-view-btn">عرض سريع</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-rating">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="review-count">(256 تقييم)</span>
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

                <div class="product-card" data-category="cds">
                    <span class="product-badge">الأكثر مبيعاً</span>
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300/00d2d3/ffffff?text=CDS+Kit" alt="طقم CDS">
                        <div class="product-overlay">
                            <button class="quick-view-btn">عرض سريع</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-rating">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="review-count">(198 تقييم)</span>
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

                <div class="product-card" data-category="dmso">
                    <span class="product-badge">الأكثر مبيعاً</span>
                    <div class="product-image">
                        <img src="https://via.placeholder.com/300x300/ff6348/ffffff?text=DMSO+Gel" alt="جل DMSO">
                        <div class="product-overlay">
                            <button class="quick-view-btn">عرض سريع</button>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-rating">
                            <span class="stars">⭐⭐⭐⭐⭐</span>
                            <span class="review-count">(312 تقييم)</span>
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
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="section categories-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🏷️ الفئات</span>
                <h2>تصفح حسب الفئة</h2>
                <p>اختر الفئة المناسبة لاحتياجاتك الصحية</p>
            </div>
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-icon">💧</div>
                    <h3>MMS</h3>
                    <p>محلول معدني معجزة للعافية</p>
                    <span class="category-count">8 منتجات</span>
                </div>
                <div class="category-card">
                    <div class="category-icon">🧪</div>
                    <h3>CDS</h3>
                    <p>محلول الكلور المركز</p>
                    <span class="category-count">6 منتجات</span>
                </div>
                <div class="category-card">
                    <div class="category-icon">💊</div>
                    <h3>DMSO</h3>
                    <p>ديميثيل سلفوكسيد الطبيعي</p>
                    <span class="category-count">5 منتجات</span>
                </div>
                <div class="category-card">
                    <div class="category-icon">🌿</div>
                    <h3>Zeolite</h3>
                    <p>زيوليت طبيعي للتنقية</p>
                    <span class="category-count">4 منتجات</span>
                </div>
                <div class="category-card">
                    <div class="category-icon">✨</div>
                    <h3>زعفران</h3>
                    <p>زعفران طبيعي فاخر</p>
                    <span class="category-count">3 منتجات</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="features-section">
        <div class="container">
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">🚚</div>
                    <h3>شحن مجاني</h3>
                    <p>للطلبات أكثر من 200 dhs إلى جميع أنحاء المغرب</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">✅</div>
                    <h3>منتجات أصلية</h3>
                    <p>جميع منتجاتنا أصلية 100% ومعتمدة</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">💳</div>
                    <h3>الدفع عند الاستلام</h3>
                    <p>ادفع بأمان عند استلام طلبك</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">📞</div>
                    <h3>دعم متواصل</h3>
                    <p>فريقنا متاح على مدار الساعة لمساعدتك</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section testimonials-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">💬 آراء العملاء</span>
                <h2>ماذا يقول عملاؤنا</h2>
                <p>تجارب حقيقية من عملاء راضين عن منتجاتنا</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="quote-icon">"</div>
                    <div class="testimonial-content">
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">
                            "منتجات رائعة وفعالة! لاحظت تحسناً كبيراً في صحتي العامة بعد استخدام منتجات Bugsi. الجودة ممتازة والخدمة احترافية جداً."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">أ</div>
                            <div class="author-info">
                                <h4>أحمد المنصوري</h4>
                                <p>الدار البيضاء</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon">"</div>
                    <div class="testimonial-content">
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">
                            "أنصح الجميع بمنتجات Bugsi! الشحن سريع والمنتجات أصلية ومعتمدة. فريق خدمة العملاء محترف ومتعاون جداً."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">ف</div>
                            <div class="author-info">
                                <h4>فاطمة الزهراء</h4>
                                <p>فاس</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="quote-icon">"</div>
                    <div class="testimonial-content">
                        <div class="testimonial-stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">
                            "تجربة تسوق رائعة! المنتجات طبيعية وفعالة، والأسعار مناسبة جداً. شكراً Bugsi على هذه الخدمة المميزة."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">ي</div>
                            <div class="author-info">
                                <h4>يوسف بنعلي</h4>
                                <p>مراكش</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-image">🌱</div>
                <div class="about-text">
                    <h2>من نحن</h2>
                    <p>في Bugsi، نحن نؤمن بقوة الحلول الصحية الطبيعية التي يقدمها الدكتور جيم همبل لتمكين الأفراد من تولي مسؤولية رفاهيتهم. نحن نوفر وصولاً موثوقًا إلى منتجاته، ونقدم تعليمًا لا يقدر بثمن، ونعزز مجتمعًا داعمًا لإرشادك في رحلتك نحو الصحة المثالية.</p>
                    <p>تذكر أن صحتك هي رحلتك، وأن Bugsi هنا ليكون دليلك الموثوق به ورفيقك على الطريق إلى العافية الطبيعية.</p>
                    <div class="about-features">
                        <div class="about-feature">
                            <div class="about-feature-icon">✓</div>
                            <span>منتجات معتمدة</span>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">✓</div>
                            <span>جودة عالية</span>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">✓</div>
                            <span>خدمة ممتازة</span>
                        </div>
                        <div class="about-feature">
                            <div class="about-feature-icon">✓</div>
                            <span>دعم مستمر</span>
                        </div>
                    </div>
                    <a href="/about" class="btn btn-primary" style="margin-top: 30px;">اقرأ المزيد</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Promo Banner -->
    <section class="promo-banner">
        <div class="container">
            <h2>🎉 عرض خاص لفترة محدودة!</h2>
            <p>احصل على خصم 20% على أول طلب لك</p>
            <a href="/shop" class="btn" style="background: white; color: var(--primary-color);">تسوق الآن</a>
        </div>
    </section>


</body>
</html>