<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="المدونة - مقالات صحية ونصائح طبيعية من Bugsi">
    <title>المدونة - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>مدونة Bugsi</h1>
                <p>اكتشف أحدث المقالات والنصائح حول الصحة الطبيعية والعافية</p>
            </div>
        </div>
    </section>

    <!-- Search & Filter Bar -->
    <div class="search-bar">
        <div class="container">
            <div class="search-container">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="ابحث عن مقال...">
                    <span class="search-icon">🔍</span>
                </div>
                <div class="category-filter">
                    <button class="filter-btn active" data-category="all">الكل</button>
                    <button class="filter-btn" data-category="health">صحة</button>
                    <button class="filter-btn" data-category="nutrition">تغذية</button>
                    <button class="filter-btn" data-category="wellness">عافية</button>
                    <button class="filter-btn" data-category="natural">طبيعي</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Post -->
    <section class="featured-section">
        <div class="container">
            <div class="featured-post fade-in">
                <div class="featured-image">
                    <img src="https://via.placeholder.com/600x450/0e9eff/ffffff?text=مقال+مميز" alt="مقال مميز">
                </div>
                <div class="featured-content">
                    <span class="featured-badge">✨ مقال مميز</span>
                    <h2>فوائد الحلول الصحية الطبيعية لجسم الإنسان</h2>
                    <div class="featured-meta">
                        <span class="meta-item">📅 15 يناير 2025</span>
                        <span class="meta-item">⏱️ 5 دقائق قراءة</span>
                        <span class="meta-item">👁️ 2,450 مشاهدة</span>
                    </div>
                    <p class="featured-excerpt">اكتشف كيف يمكن للمنتجات الطبيعية أن تحدث فرقاً حقيقياً في صحتك اليومية. نستعرض في هذا المقال المفصل أهم الفوائد العلمية المثبتة للحلول الصحية الطبيعية وكيفية دمجها في روتينك اليومي.</p>
                    <a href="#" class="read-more-btn">اقرأ المقال كاملاً</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="section blog-section">
        <div class="container">
            <div class="section-header">
                <h2>أحدث المقالات</h2>
                <p>مقالات ونصائح قيمة من خبراء الصحة الطبيعية</p>
            </div>

            <div class="blog-grid">
                <!-- Blog Card 1 -->
                <div class="blog-card fade-in" data-category="health">
                    <div class="blog-image">
                        <img src="https://via.placeholder.com/400x250/00d2d3/ffffff?text=MMS" alt="MMS">
                        <span class="blog-category">صحة</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span>📅 12 يناير 2025</span>
                            <span>⏱️ 4 دقائق</span>
                        </div>
                        <h3>دليلك الشامل لاستخدام MMS بطريقة آمنة وفعالة</h3>
                        <p class="blog-excerpt">تعرف على الطرق الصحيحة لاستخدام محلول MMS وفوائده الصحية المتعددة للجسم...</p>
                        <div class="blog-footer">
                            <div class="blog-author">
                                <div class="author-avatar">د</div>
                                <span>د. أحمد الصحراوي</span>
                            </div>
                            <span class="read-time">4 دقائق</span>
                        </div>
                    </div>
                </div>

                <!-- Blog Card 2 -->
                <div class="blog-card fade-in" data-category="nutrition">
                    <div class="blog-image">
                        <img src="https://via.placeholder.com/400x250/ffd700/ffffff?text=زعفران" alt="زعفران">
                        <span class="blog-category">تغذية</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span>📅 10 يناير 2025</span>
                            <span>⏱️ 6 دقائق</span>
                        </div>
                        <h3>الزعفران: الذهب الأحمر وفوائده الصحية المذهلة</h3>
                        <p class="blog-excerpt">اكتشف لماذا يعتبر الزعفران من أغلى التوابل في العالم وكيف يمكن أن يحسن صحتك...</p>
                        <div class="blog-footer">
                            <div class="blog-author">
                                <div class="author-avatar">ف</div>
                                <span>فاطمة بنعلي</span>
                            </div>
                            <span class="read-time">6 دقائق</span>
                        </div>
                    </div>
                </div>

                <!-- Blog Card 3 -->
                <div class="blog-card fade-in" data-category="wellness">
                    <div class="blog-image">
                        <img src="https://via.placeholder.com/400x250/ff6348/ffffff?text=DMSO" alt="DMSO">
                        <span class="blog-category">عافية</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span>📅 8 يناير 2025</span>
                            <span>⏱️ 5 دقائق</span>
                        </div>
                        <h3>DMSO: الحل الطبيعي لتخفيف الآلام والالتهابات</h3>
                        <p class="blog-excerpt">تعرف على خصائص DMSO الفريدة وكيف يساعد في تخفيف الآلام بطريقة طبيعية...</p>
                        <div class="blog-footer">
                            <div class="blog-author">
                                <div class="author-avatar">ي</div>
                                <span>يوسف المنصوري</span>
                            </div>
                            <span class="read-time">5 دقائق</span>
                        </div>
                    </div>
                </div>

                <!-- Blog Card 4 -->
                <div class="blog-card fade-in" data-category="natural">
                    <div class="blog-image">
                        <img src="https://via.placeholder.com/400x250/0e9eff/ffffff?text=Zeolite" alt="Zeolite">
                        <span class="blog-category">طبيعي</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span>📅 5 يناير 2025</span>
                            <span>⏱️ 7 دقائق</span>
                        </div>
                        <h3>الزيوليت الطبيعي: معدن التنقية والتطهير</h3>
                        <p class="blog-excerpt">اكتشف قدرة الزيوليت الفريدة على تنقية الجسم من السموم والمعادن الثقيلة...</p>
                        <div class="blog-footer">
                            <div class="blog-author">
                                <div class="author-avatar">د</div>
                                <span>د. أحمد الصحراوي</span>
                            </div>
                            <span class="read-time">7 دقائق</span>
                        </div>
                    </div>
                </div>

                <!-- Blog Card 5 -->
                <div class="blog-card fade-in" data-category="health">
                    <div class="blog-image">
                        <img src="https://via.placeholder.com/400x250/00d2d3/ffffff?text=CDS" alt="CDS">
                        <span class="blog-category">صحة</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span>📅 3 يناير 2025</span>
                            <span>⏱️ 5 دقائق</span>
                        </div>
                        <h3>الفرق بين MMS و CDS وأيهما أفضل لك</h3>
                        <p class="blog-excerpt">دليل شامل يوضح الفروقات الأساسية بين المحلولين ومتى تستخدم كل منهما...</p>
                        <div class="blog-footer">
                            <div class="blog-author">
                                <div class="author-avatar">ف</div>
                                <span>فاطمة بنعلي</span>
                            </div>
                            <span class="read-time">5 دقائق</span>
                        </div>
                    </div>
                </div>

                <!-- Blog Card 6 -->
                <div class="blog-card fade-in" data-category="wellness">
                    <div class="blog-image">
                        <img src="https://via.placeholder.com/400x250/0e9eff/ffffff?text=صحة+طبيعية" alt="صحة طبيعية">
                        <span class="blog-category">عافية</span>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span>📅 1 يناير 2025</span>
                            <span>⏱️ 8 دقائق</span>
                        </div>
                        <h3>10 نصائح لتعزيز مناعتك بطرق طبيعية</h3>
                        <p class="blog-excerpt">نصائح عملية وسهلة التطبيق لتقوية جهازك المناعي باستخدام الحلول الطبيعية...</p>
                        <div class="blog-footer">
                            <div class="blog-author">
                                <div class="author-avatar">ي</div>
                                <span>يوسف المنصوري</span>
                            </div>
                            <span class="read-time">8 دقائق</span>
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
                <button class="pagination-btn">4</button>
                <button class="pagination-btn">التالي</button>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="categories-section">
        <div class="container">
            <div class="section-header">
                <h2>تصفح حسب الفئة</h2>
                <p>اختر المواضيع التي تهمك</p>
            </div>
            <div class="categories-grid">
                <div class="category-card">
                    <div class="category-icon">🏥</div>
                    <h3>صحة عامة</h3>
                    <p class="category-count">24 مقال</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">🥗</div>
                    <h3>تغذية صحية</h3>
                    <p class="category-count">18 مقال</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">🧘</div>
                    <h3>عافية ذهنية</h3>
                    <p class="category-count">15 مقال</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">🌿</div>
                    <h3>علاجات طبيعية</h3>
                    <p class="category-count">32 مقال</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">💊</div>
                    <h3>مكملات غذائية</h3>
                    <p class="category-count">21 مقال</p>
                </div>
                <div class="category-card">
                    <div class="category-icon">🏃</div>
                    <h3>نمط حياة صحي</h3>
                    <p class="category-count">19 مقال</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>📧 اشترك في نشرتنا البريدية</h2>
                <p>احصل على أحدث المقالات والنصائح الصحية مباشرة في بريدك</p>
                <form class="newsletter-form" id="newsletterForm">
                    <input type="email" placeholder="أدخل بريدك الإلكتروني" required>
                    <button type="submit">اشترك الآن</button>
                </form>
            </div>
        </div>
    </section>


</body>
</html>