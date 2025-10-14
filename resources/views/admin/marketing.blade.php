<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التسويق والبريد - Bugsi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/marketing.css') }}">
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
                    <h1 class="page-title">التسويق والبريد الإلكتروني</h1>
                    <p class="page-subtitle">إدارة الحملات التسويقية والتواصل مع العملاء</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-secondary" onclick="viewSubscribers()">
                        <span>👥</span>
                        المشتركين
                    </button>
                    <button class="btn btn-primary" onclick="openCampaignModal()">
                        <span>➕</span>
                        حملة جديدة
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon blue">📧</div>
                        <div class="stat-trend up">+18.5%</div>
                    </div>
                    <div class="stat-label">الحملات المرسلة</div>
                    <div class="stat-value">24</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon green">👥</div>
                        <div class="stat-trend up">+12.3%</div>
                    </div>
                    <div class="stat-label">إجمالي المشتركين</div>
                    <div class="stat-value">1,842</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon orange">📊</div>
                    </div>
                    <div class="stat-label">معدل الفتح</div>
                    <div class="stat-value">42.8%</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon purple">🖱️</div>
                    </div>
                    <div class="stat-label">معدل النقر</div>
                    <div class="stat-value">18.5%</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Campaigns List -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">📨 الحملات الأخيرة</h2>
                        <a class="card-action" onclick="viewAllCampaigns()">عرض الكل ←</a>
                    </div>

                    <div class="campaigns-list" id="campaignsList">
                        <!-- Campaigns will be inserted here -->
                    </div>
                </div>

                <!-- Email Templates -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">📄 قوالب البريد</h2>
                    </div>

                    <div class="templates-grid">
                        <div class="template-item" onclick="useTemplate('welcome')">
                            <div class="template-icon">👋</div>
                            <div class="template-info">
                                <div class="template-name">رسالة ترحيبية</div>
                                <div class="template-desc">للمشتركين الجدد</div>
                            </div>
                        </div>

                        <div class="template-item" onclick="useTemplate('offer')">
                            <div class="template-icon">🎁</div>
                            <div class="template-info">
                                <div class="template-name">عرض خاص</div>
                                <div class="template-desc">للعروض والخصومات</div>
                            </div>
                        </div>

                        <div class="template-item" onclick="useTemplate('newsletter')">
                            <div class="template-icon">📰</div>
                            <div class="template-info">
                                <div class="template-name">نشرة إخبارية</div>
                                <div class="template-desc">أخبار ومستجدات</div>
                            </div>
                        </div>

                        <div class="template-item" onclick="useTemplate('abandoned')">
                            <div class="template-icon">🛒</div>
                            <div class="template-info">
                                <div class="template-name">سلة متروكة</div>
                                <div class="template-desc">تذكير بالمنتجات</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscribers Card -->
            <div class="subscribers-card">
                <div class="card-header">
                    <h2 class="card-title">👥 إحصائيات المشتركين</h2>
                    <a class="card-action" onclick="exportSubscribers()">تصدير القائمة ←</a>
                </div>

                <div class="subscribers-stats">
                    <div class="subscriber-stat">
                        <div class="subscriber-stat-value">1,842</div>
                        <div class="subscriber-stat-label">إجمالي المشتركين</div>
                    </div>
                    <div class="subscriber-stat">
                        <div class="subscriber-stat-value">127</div>
                        <div class="subscriber-stat-label">مشتركين جدد</div>
                    </div>
                    <div class="subscriber-stat">
                        <div class="subscriber-stat-value">23</div>
                        <div class="subscriber-stat-label">إلغاء الاشتراك</div>
                    </div>
                    <div class="subscriber-stat">
                        <div class="subscriber-stat-value">1,819</div>
                        <div class="subscriber-stat-label">مشتركين نشطين</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Campaign Modal -->
    <div class="modal" id="campaignModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">إنشاء حملة بريدية جديدة</h2>
                <button class="close-btn" onclick="closeCampaignModal()">×</button>
            </div>

            <form id="campaignForm">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label class="form-label">اسم الحملة *</label>
                        <input type="text" class="form-input" id="campaignName" placeholder="مثال: عرض نهاية الموسم" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">نوع الحملة *</label>
                        <select class="form-select" id="campaignType" required>
                            <option value="">اختر النوع</option>
                            <option value="promotional">ترويجية</option>
                            <option value="newsletter">نشرة إخبارية</option>
                            <option value="announcement">إعلان</option>
                            <option value="welcome">ترحيبية</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">القالب</label>
                        <select class="form-select" id="campaignTemplate">
                            <option value="">بدون قالب</option>
                            <option value="welcome">رسالة ترحيبية</option>
                            <option value="offer">عرض خاص</option>
                            <option value="newsletter">نشرة إخبارية</option>
                            <option value="abandoned">سلة متروكة</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">موضوع الرسالة *</label>
                        <input type="text" class="form-input" id="campaignSubject" placeholder="مثال: خصم 30% على جميع المنتجات!" required>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">محتوى الرسالة *</label>
                        <textarea class="form-textarea" id="campaignContent" placeholder="اكتب محتوى الرسالة هنا..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الجمهور المستهدف *</label>
                        <select class="form-select" id="campaignAudience" required>
                            <option value="all">جميع المشتركين</option>
                            <option value="customers">العملاء فقط</option>
                            <option value="subscribers">المشتركين الجدد</option>
                            <option value="inactive">غير النشطين</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">الحالة</label>
                        <select class="form-select" id="campaignStatus">
                            <option value="draft">مسودة</option>
                            <option value="scheduled">جدولة</option>
                            <option value="send-now">إرسال الآن</option>
                        </select>
                    </div>

                    <div class="form-group full-width" id="scheduleGroup" style="display: none;">
                        <label class="form-label">موعد الإرسال</label>
                        <input type="datetime-local" class="form-input" id="scheduleDate">
                    </div>
                </div>

                <div class="quick-stats">
                    <div class="quick-stat">
                        <div class="quick-stat-value" id="estimatedRecipients">1,842</div>
                        <div class="quick-stat-label">عدد المستلمين المقدر</div>
                    </div>
                    <div class="quick-stat">
                        <div class="quick-stat-value">~45%</div>
                        <div class="quick-stat-label">معدل الفتح المتوقع</div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeCampaignModal()">
                        إلغاء
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span>📧</span>
                        إنشاء الحملة
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/admin/marketing.js') }}"></script>
</body>
</html>