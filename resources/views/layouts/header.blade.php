<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bugsi Shop - متجر المنتجات الصحية</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
</head>
<body>
    <!-- Promotional Banner -->
    <div class="promo-banner">
        🎉 عرض خاص: شحن مجاني للطلبات فوق <span>200 درهم</span> 🎉
    </div>

    <!-- Main Header -->
    <header class="header" id="mainHeader">
        <div class="header-content">
            <!-- Logo -->
            <a href="/" class="logo-container">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="white"/>
                        <path d="M2 17L12 22L22 17V12L12 17L2 12V17Z" fill="white" opacity="0.7"/>
                    </svg>
                </div>
                <div class="logo-text">
                    <div class="logo-title">Bugsi</div>
                    <div class="logo-subtitle">منتجات صحية طبيعية</div>
                </div>
            </a>

            <!-- Navigation -->
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="/" class="nav-link active">
                            <span>🏠</span>
                            الرئيسية
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/shop" class="nav-link">
                            <span>🛍️</span>
                            المتجر
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/about" class="nav-link">
                            <span>ℹ️</span>
                            من نحن
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/contact" class="nav-link">
                            <span>📞</span>
                            تواصل معنا
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Header Actions -->
            <div class="header-actions">
                <button class="search-toggle" onclick="toggleSearch()">
                    🔍
                </button>

                <button class="cart-btn" onclick="window.location.href='/cart'">
                    🛒
                    <span class="cart-badge">3</span>
                </button>

                <a href="/login" class="auth-btn btn-login">
                    <span>👤</span>
                    دخول
                </a>

                <a href="/register" class="auth-btn btn-register">
                    <span>✨</span>
                    تسجيل جديد
                </a>

                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <nav class="mobile-nav" id="mobileNav">
            <ul class="mobile-nav-list">
                <li><a href="/" class="mobile-nav-link active">🏠 الرئيسية</a></li>
                <li><a href="/shop" class="mobile-nav-link">🛍️ المتجر</a></li>
                <li><a href="/about" class="mobile-nav-link">ℹ️ من نحن</a></li>
                <li><a href="/contact" class="mobile-nav-link">📞 تواصل معنا</a></li>
            </ul>
            <div class="mobile-auth">
                <a href="/login" class="auth-btn btn-login">👤 دخول</a>
                <a href="/register" class="auth-btn btn-register">✨ تسجيل</a>
            </div>
        </nav>
    </header>

    <!-- Search Overlay -->
    <div class="search-overlay" id="searchOverlay">
        <button class="search-close" onclick="toggleSearch()">×</button>
        <div class="search-box">
            <input type="text" class="search-input" placeholder="ابحث عن المنتجات...">
            <button class="search-submit">🔍</button>
        </div>
    </div>
    <script src="{{ asset('assets/js/header.js') }}"></script>
</body>
</html>