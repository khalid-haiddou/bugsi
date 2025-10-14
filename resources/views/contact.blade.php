<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="تواصل معنا - Bugsi للحلول الصحية الطبيعية">
    <title>تواصل معنا - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>تواصل معنا</h1>
                <p>نحن هنا للإجابة على جميع استفساراتك ومساعدتك في رحلتك الصحية</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Form -->
                <div class="contact-form fade-in">
                    <h2>أرسل لنا رسالة</h2>
                    <p>املأ النموذج أدناه وسنرد عليك في أقرب وقت ممكن</p>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">الاسم الكامل *</label>
                            <input type="text" id="name" name="name" required placeholder="أدخل اسمك الكامل">
                        </div>
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني *</label>
                            <input type="email" id="email" name="email" required placeholder="example@email.com">
                        </div>
                        <div class="form-group">
                            <label for="phone">رقم الهاتف</label>
                            <input type="tel" id="phone" name="phone" placeholder="+212 XXX-XXXXXX">
                        </div>
                        <div class="form-group">
                            <label for="message">رسالتك *</label>
                            <textarea id="message" name="message" required placeholder="اكتب رسالتك هنا..."></textarea>
                        </div>
                        <button type="submit" class="submit-btn">إرسال الرسالة</button>
                        <div class="form-message" id="formMessage"></div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="contact-info">
                    <div class="info-card fade-in">
                        <div class="info-icon">📞</div>
                        <div class="info-content">
                            <h3>اتصل بنا</h3>
                            <p>هل لديك سؤال؟ اتصل بنا الآن</p>
                            <a href="tel:+212XXXXXXXXX">+212 XXX-XXXXXX</a>
                        </div>
                    </div>

                    <div class="info-card fade-in">
                        <div class="info-icon">📧</div>
                        <div class="info-content">
                            <h3>البريد الإلكتروني</h3>
                            <p>راسلنا عبر البريد الإلكتروني</p>
                            <a href="mailto:info@bugsi.shop">info@bugsi.shop</a>
                        </div>
                    </div>

                    <div class="info-card fade-in">
                        <div class="info-icon">📍</div>
                        <div class="info-content">
                            <h3>العنوان</h3>
                            <p>المغرب<br>فاس - المدينة</p>
                        </div>
                    </div>

                    <div class="info-card fade-in">
                        <div class="info-icon">⏰</div>
                        <div class="info-content">
                            <h3>ساعات العمل</h3>
                            <p>الإثنين - السبت: 9:00 - 18:00<br>الأحد: مغلق</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="section map-section">
        <div class="container">
            <div class="section-header">
                <h2>موقعنا</h2>
                <p>يمكنك زيارتنا في أي وقت خلال ساعات العمل</p>
            </div>
            <div class="map-container fade-in">
                🗺️
                <!-- في Laravel، يمكنك إضافة خريطة Google Maps هنا -->
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section faq-section">
        <div class="container">
            <div class="section-header">
                <h2>الأسئلة الشائعة</h2>
                <p>إجابات سريعة على الأسئلة الأكثر شيوعاً</p>
            </div>
            <div class="faq-grid">
                <div class="faq-item fade-in">
                    <h3>كم يستغرق التوصيل؟</h3>
                    <p>عادةً ما يستغرق التوصيل من 2 إلى 5 أيام عمل حسب موقعك داخل المغرب.</p>
                </div>
                <div class="faq-item fade-in">
                    <h3>هل المنتجات أصلية؟</h3>
                    <p>نعم، جميع منتجاتنا أصلية 100% ومعتمدة من مصادر موثوقة.</p>
                </div>
                <div class="faq-item fade-in">
                    <h3>كيف يمكنني الدفع؟</h3>
                    <p>نوفر خدمة الدفع عند الاستلام لراحتك وأمانك.</p>
                </div>
                <div class="faq-item fade-in">
                    <h3>هل يمكنني إرجاع المنتج؟</h3>
                    <p>نعم، لديك 7 أيام لإرجاع المنتج إذا لم يكن مفتوحاً أو مستعملاً.</p>
                </div>
                <div class="faq-item fade-in">
                    <h3>هل تقدمون استشارات؟</h3>
                    <p>نعم، فريقنا متاح لتقديم النصائح حول استخدام المنتجات.</p>
                </div>
                <div class="faq-item fade-in">
                    <h3>هل هناك شحن مجاني؟</h3>
                    <p>نعم، نوفر شحن مجاني للطلبات التي تزيد عن 200 dhs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Working Hours -->
    <section class="hours-section">
        <div class="container">
            <div class="hours-content">
                <h2>ساعات العمل</h2>
                <div class="hours-grid">
                    <div class="hour-item">
                        <h3>الإثنين - الجمعة</h3>
                        <p>9:00 صباحاً - 6:00 مساءً</p>
                    </div>
                    <div class="hour-item">
                        <h3>السبت</h3>
                        <p>10:00 صباحاً - 4:00 مساءً</p>
                    </div>
                    <div class="hour-item">
                        <h3>الأحد</h3>
                        <p>مغلق</p>
                    </div>
                    <div class="hour-item">
                        <h3>دعم العملاء</h3>
                        <p>متاح 24/7 عبر WhatsApp</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media -->
    <section class="social-section">
        <div class="container">
            <div class="social-content">
                <h3>تابعنا على وسائل التواصل الاجتماعي</h3>
                <div class="social-links">
                    <a href="#" class="social-link facebook" title="Facebook">📘</a>
                    <a href="#" class="social-link instagram" title="Instagram">📷</a>
                    <a href="#" class="social-link whatsapp" title="WhatsApp">💬</a>
                    <a href="mailto:info@bugsi.shop" class="social-link email" title="Email">📧</a>
                </div>
            </div>
        </div>
    </section>


</body>
</html>