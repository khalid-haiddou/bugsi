<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="تم تأكيد طلبك - Bugsi">
    <title>تم تأكيد الطلب - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/thanks.css') }}">
</head>
<body>
    @include('layouts.header')
    <section class="success-section">
        <div class="container">
            <!-- Success Header -->
            <div class="success-header">
                <div class="success-icon">✓</div>
                <h1 class="success-title">شكراً لك على طلبك!</h1>
                <p class="success-message">تم استلام طلبك بنجاح وسنبدأ في معالجته قريباً</p>
                <div class="order-number">رقم الطلب: #12345</div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="/" class="btn btn-primary">
                    <span>🏠</span>
                    العودة للرئيسية
                </a>
                <a href="/shop" class="btn btn-secondary">
                    <span>🛍️</span>
                    متابعة التسوق
                </a>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <div class="info-box-title">
                    <span>📧</span>
                    تم إرسال تأكيد الطلب
                </div>
                <div class="info-box-text">
                    لقد أرسلنا رسالة تأكيد إلى بريدك الإلكتروني تحتوي على تفاصيل طلبك. سيتم التواصل معك عبر الهاتف لتأكيد الطلب قبل الشحن.
                </div>
            </div>

            <!-- Order Details -->
            <div class="order-card">
                <h2 class="card-title">
                    <span>📦</span>
                    تفاصيل الطلب
                </h2>

                <div class="order-items">
                    <div class="order-item">
                        <div class="item-image">
                            <img src="https://via.placeholder.com/150x150/0e9eff/ffffff?text=MMS" alt="MMS">
                        </div>
                        <div class="item-info">
                            <div class="item-name">MMS - محلول معدني معجزة</div>
                            <div class="item-meta">الكمية: 2 × 150 dhs</div>
                            <div class="item-price">300 dhs</div>
                        </div>
                    </div>

                    <div class="order-item">
                        <div class="item-image">
                            <img src="https://via.placeholder.com/150x150/00d2d3/ffffff?text=CDS" alt="CDS">
                        </div>
                        <div class="item-info">
                            <div class="item-name">CDS - محلول الكلور المركز</div>
                            <div class="item-meta">الكمية: 1 × 220 dhs</div>
                            <div class="item-price">220 dhs</div>
                        </div>
                    </div>
                </div>

                <div class="order-summary">
                    <div class="summary-row">
                        <span class="summary-label">المجموع الفرعي</span>
                        <span class="summary-value">520 dhs</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">رسوم الشحن</span>
                        <span class="summary-value" style="color: var(--success);">مجاناً</span>
                    </div>
                    <div class="summary-row total">
                        <span class="summary-label">الإجمالي</span>
                        <span class="summary-value">520 dhs</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="order-card">
                <h2 class="card-title">
                    <span>🚚</span>
                    معلومات الشحن
                </h2>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">الاسم</div>
                        <div class="info-value">أحمد المنصوري</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">رقم الهاتف</div>
                        <div class="info-value">+212 XXX-XXXXXX</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">المدينة</div>
                        <div class="info-value">الدار البيضاء</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">طريقة الدفع</div>
                        <div class="info-value">الدفع عند الاستلام 💵</div>
                    </div>
                </div>

                <div class="info-item" style="margin-top: 20px;">
                    <div class="info-label">العنوان</div>
                    <div class="info-value">شارع محمد الخامس، حي المعاريف، الدار البيضاء</div>
                </div>
            </div>

            <!-- Order Status -->
            <div class="order-card">
                <h2 class="card-title">
                    <span>⏱️</span>
                    حالة الطلب
                </h2>

                <div class="status-timeline">
                    <div class="timeline-item active">
                        <div class="timeline-icon">✓</div>
                        <div class="timeline-content">
                            <div class="timeline-title">تم استلام الطلب</div>
                            <div class="timeline-desc">لقد تم تأكيد طلبك بنجاح</div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon">📞</div>
                        <div class="timeline-content">
                            <div class="timeline-title">تأكيد الطلب</div>
                            <div class="timeline-desc">سنتصل بك لتأكيد التفاصيل</div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon">📦</div>
                        <div class="timeline-content">
                            <div class="timeline-title">جاري التحضير</div>
                            <div class="timeline-desc">نقوم بتحضير طلبك للشحن</div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon">🚚</div>
                        <div class="timeline-content">
                            <div class="timeline-title">في الطريق</div>
                            <div class="timeline-desc">الطلب في طريقه إليك</div>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-icon">🎉</div>
                        <div class="timeline-content">
                            <div class="timeline-title">تم التسليم</div>
                            <div class="timeline-desc">استلام الطلب بنجاح</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Section -->
            <div class="help-section">
                <h3>هل تحتاج إلى مساعدة؟</h3>
                <p>فريق خدمة العملاء لدينا جاهز لمساعدتك في أي وقت</p>
                <div class="contact-info">
                    <div class="contact-item">
                        <span class="contact-icon">📞</span>
                        <span>+212 XXX-XXXXXX</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📧</span>
                        <span>info@bugsi.shop</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">💬</span>
                        <span>واتساب: متاح 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/js/thanks.js') }}"></script>
</body>
</html>