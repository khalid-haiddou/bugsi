<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/sidebar.css') }}">
</head>

<body>
    <!-- resources/views/admin/sidebar.blade.php -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="logo-container">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#0e9eff"/>
                    <path d="M2 17L12 22L22 17V12L12 17L2 12V17Z" fill="#0077cc"/>
                    <path d="M2 12L12 17L22 12" stroke="#0e9eff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="logo">Bugsi</div>
        </div>
        <div class="logo-subtitle">لوحة التحكم الإدارية</div>
    </div>
    
    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">القائمة الرئيسية</div>
            <a href="/admin/dashboard" class="nav-item">
                <span class="nav-icon">📊</span>
                <span>لوحة التحكم</span>
            </a>
            <a href="/admin/orders" class="nav-item">
                <span class="nav-icon">📦</span>
                <span>إدارة الطلبات</span>
                <span class="nav-badge">12</span>
            </a>
            <a href="/admin/products" class="nav-item">
                <span class="nav-icon">🛍️</span>
                <span>إدارة المنتجات</span>
            </a>
            <a href="/admin/categories" class="nav-item active">
                <span class="nav-icon">📂</span>
                <span>إدارة الفئات</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">الشحن والتوصيل</div>
            <a href="/admin/shipping" class="nav-item">
                <span class="nav-icon">🚚</span>
                <span>إدارة الشحن</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">الدعم والتواصل</div>
            <a href="/admin/tickets" class="nav-item">
                <span class="nav-icon">🎫</span>
                <span>التذاكر والدعم</span>
                <span class="nav-badge">5</span>
            </a>
            <a href="/admin/contact-messages" class="nav-item">
                <span class="nav-icon">💬</span>
                <span>رسائل التواصل</span>
                <span class="nav-badge">8</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">التسويق والبيانات</div>
            <a href="/admin/marketing" class="nav-item">
                <span class="nav-icon">📧</span>
                <span>التسويق والبريد</span>
            </a>
            <a href="/admin/statistics" class="nav-item">
                <span class="nav-icon">📈</span>
                <span>الإحصائيات</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">الإعدادات</div>
            <a href="/admin/settings" class="nav-item">
                <span class="nav-icon">⚙️</span>
                <span>الإعدادات</span>
            </a>
            <a href="/logout" class="nav-item">
                <span class="nav-icon">🚪</span>
                <span>تسجيل الخروج</span>
            </a>
        </div>
    </nav>
</aside>
<script src="{{ asset('assets/js/admin/sidebar.js') }}"></script>

</body>
</html>