<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="من نحن - Bugsi متجر الحلول الصحية الطبيعية">
    <title>من نحن - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
</head>
<body>
    @include('layouts.header') 
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>من نحن</h1>
                <p>دليلك الموثوق نحو العافية الطبيعية والصحة المثالية</p>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="section story-section">
        <div class="container">
            <div class="story-content">
                <div class="story-image fade-in">🌱</div>
                <div class="story-text fade-in">
                    <h2>قصتنا</h2>
                    <p>في Bugsi، نحن نؤمن بقوة الحلول الصحية الطبيعية التي يقدمها الدكتور جيم همبل لتمكين الأفراد من تولي مسؤولية رفاهيتهم. نحن نوفر وصولاً موثوقًا إلى منتجاته، ونقدم تعليمًا لا يقدر بثمن، ونعزز مجتمعًا داعمًا لإرشادك في رحلتك نحو الصحة المثالية.</p>
                    <p>نحن ملتزمون بتوفير منتجات صحية طبيعية عالية الجودة تساعدك على تحقيق أهدافك الصحية. من خلال شراكتنا مع خبراء الصحة الطبيعية، نضمن لك الحصول على أفضل المنتجات وأكثرها فعالية.</p>
                    <div class="highlight-text">
                        تذكر أن صحتك هي رحلتك، وأن Bugsi هنا ليكون دليلك الموثوق به ورفيقك على الطريق إلى العافية الطبيعية.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="section values-section section-light">
        <div class="container">
            <div class="section-header">
                <h2>قيمنا الأساسية</h2>
                <p>المبادئ التي نسير عليها في رحلتنا لخدمتكم</p>
            </div>
            <div class="values-grid">
                <div class="value-card fade-in">
                    <div class="value-icon">🎯</div>
                    <h3>الجودة أولاً</h3>
                    <p>نلتزم بتقديم منتجات طبيعية عالية الجودة ومعتمدة من مصادر موثوقة</p>
                </div>
                <div class="value-card fade-in">
                    <div class="value-icon">💚</div>
                    <h3>الأمانة والشفافية</h3>
                    <p>نؤمن بالصدق والوضوح في جميع تعاملاتنا مع عملائنا</p>
                </div>
                <div class="value-card fade-in">
                    <div class="value-icon">🤝</div>
                    <h3>دعم مستمر</h3>
                    <p>فريقنا متواجد دائماً لمساعدتك في رحلتك الصحية</p>
                </div>
                <div class="value-card fade-in">
                    <div class="value-icon">🌿</div>
                    <h3>طبيعي 100%</h3>
                    <p>جميع منتجاتنا طبيعية خالية من المواد الكيميائية الضارة</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="section why-section">
        <div class="container">
            <div class="section-header">
                <h2>لماذا تختار Bugsi؟</h2>
                <p>نقدم لك تجربة فريدة في عالم الصحة الطبيعية</p>
            </div>
            <div class="why-grid">
                <div class="why-item fade-in">
                    <div class="why-icon">✅</div>
                    <div class="why-content">
                        <h3>منتجات أصلية ومعتمدة</h3>
                        <p>نضمن لك الحصول على منتجات أصلية 100% من مصادر موثوقة ومعتمدة دولياً</p>
                    </div>
                </div>
                <div class="why-item fade-in">
                    <div class="why-icon">🚚</div>
                    <div class="why-content">
                        <h3>توصيل سريع وآمن</h3>
                        <p>نوفر خدمة توصيل سريعة إلى جميع مدن المغرب مع ضمان سلامة المنتجات</p>
                    </div>
                </div>
                <div class="why-item fade-in">
                    <div class="why-icon">💳</div>
                    <div class="why-content">
                        <h3>الدفع عند الاستلام</h3>
                        <p>راحتك وأمانك أولوية، يمكنك الدفع بأمان عند استلام طلبك</p>
                    </div>
                </div>
                <div class="why-item fade-in">
                    <div class="why-icon">📚</div>
                    <div class="why-content">
                        <h3>تعليم ومعرفة</h3>
                        <p>نقدم معلومات قيمة وإرشادات حول كيفية استخدام المنتجات بشكل صحيح</p>
                    </div>
                </div>
                <div class="why-item fade-in">
                    <div class="why-icon">🏆</div>
                    <div class="why-content">
                        <h3>سمعة موثوقة</h3>
                        <p>آلاف العملاء الراضين يثقون في منتجاتنا وخدماتنا</p>
                    </div>
                </div>
                <div class="why-item fade-in">
                    <div class="why-icon">💬</div>
                    <div class="why-content">
                        <h3>مجتمع داعم</h3>
                        <p>انضم إلى مجتمعنا من الأشخاص الذين يسعون لحياة صحية أفضل</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <h2 style="font-size: 42px; margin-bottom: 20px;">أرقامنا تتحدث</h2>
            <p style="font-size: 18px; opacity: 0.95;">إنجازاتنا في خدمة الصحة الطبيعية</p>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">5000+</div>
                    <div class="stat-label">عميل سعيد</div>
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
                    <div class="stat-number">3+</div>
                    <div class="stat-label">سنوات خبرة</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="section mission-section">
        <div class="container">
            <div class="mission-content fade-in">
                <div class="mission-icon">🎯</div>
                <h2>رسالتنا</h2>
                <p>نسعى لتمكين الأفراد من تحقيق صحة مثالية من خلال توفير منتجات طبيعية عالية الجودة، وتقديم المعرفة والتوجيه اللازم، وبناء مجتمع داعم يشجع على نمط حياة صحي ومستدام.</p>
                <p>نؤمن بأن كل شخص يستحق الوصول إلى حلول صحية طبيعية وآمنة، ونلتزم بأن نكون الشريك الموثوق في رحلة كل فرد نحو العافية الكاملة.</p>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section team-section">
        <div class="container">
            <div class="section-header">
                <h2>فريق العمل</h2>
                <p>خبراء متخصصون في الصحة الطبيعية</p>
            </div>
            <div class="team-grid">
                <div class="team-card fade-in">
                    <div class="team-image">👨‍⚕️</div>
                    <div class="team-info">
                        <h3>د. أحمد الصحراوي</h3>
                        <p>خبير في الصحة الطبيعية</p>
                        <span>مستشار طبي</span>
                    </div>
                </div>
                <div class="team-card fade-in">
                    <div class="team-image">👩‍💼</div>
                    <div class="team-info">
                        <h3>فاطمة بنعلي</h3>
                        <p>مديرة خدمة العملاء</p>
                        <span>دعم العملاء</span>
                    </div>
                </div>
                <div class="team-card fade-in">
                    <div class="team-image">👨‍🔬</div>
                    <div class="team-info">
                        <h3>يوسف المنصوري</h3>
                        <p>متخصص في مراقبة الجودة</p>
                        <span>ضمان الجودة</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>ابدأ رحلتك الصحية اليوم</h2>
            <p>انضم إلى آلاف العملاء الذين اختاروا الطريق الطبيعي للعافية</p>
            <a href="/shop" class="btn">تسوق الآن</a>
        </div>
    </section>
    <script src="{{ asset('assets/js/about.js') }}"></script>
</body>
</html>