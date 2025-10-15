<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="سلة التسوق - Bugsi">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>سلة التسوق - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}">
</head>
<body>
    @include('layouts.header')
    
    <!-- Cart Section -->
    <section class="cart-section">
        <div class="container">
            <h1 class="page-title">سلة التسوق</h1>
            <p class="page-subtitle">لديك <span id="itemCount">0</span> منتجات في سلتك</p>

            <!-- Success Message -->
            <div id="successMessage" class="success-message">
                <span>✓</span>
                <span id="successText">تم تطبيق كود الخصم بنجاح!</span>
            </div>

            <!-- Loading State -->
            <div id="cartLoading" class="cart-loading">
                <div class="loading-spinner"></div>
                <p>جاري تحميل السلة...</p>
            </div>

            <!-- Cart Layout -->
            <div class="cart-layout" id="cartLayout" style="display: none;">
                <!-- Cart Items -->
                <div class="cart-items" id="cartItems">
                    <!-- Items will be loaded by JavaScript -->
                </div>

                <!-- Cart Summary -->
                <div class="cart-summary">
                    <h2 class="summary-title">ملخص الطلب</h2>

                    <div class="coupon-section">
                        <div class="coupon-input-wrapper">
                            <input type="text" class="coupon-input" id="couponInput" placeholder="أدخل كود الخصم">
                            <button class="apply-coupon-btn" id="applyCoupon">تطبيق</button>
                        </div>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">المجموع الفرعي:</span>
                        <span class="summary-value" id="subtotal">0 MAD</span>
                    </div>

                    <div class="summary-row" id="discountRow" style="display: none;">
                        <span class="summary-label">الخصم:</span>
                        <span class="summary-value discount-value" id="discount">-0 MAD</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">الشحن:</span>
                        <span class="summary-value" id="shipping">مجاني</span>
                    </div>

                    <div class="summary-total">
                        <div class="summary-row">
                            <span class="summary-label">الإجمالي:</span>
                            <span class="summary-value" id="total">0 MAD</span>
                        </div>
                    </div>

                    <button class="checkout-btn" id="checkoutBtn">
                        إتمام الطلب
                    </button>

                    <div class="secure-checkout">
                        <span>🔒</span>
                        <span>دفع آمن ومشفر</span>
                    </div>
                </div>
            </div>

            <!-- Empty Cart -->
            <div class="empty-cart" id="emptyCart" style="display: none;">
                <div class="empty-icon">🛒</div>
                <h2 class="empty-title">سلة التسوق فارغة</h2>
                <p class="empty-text">لم تقم بإضافة أي منتجات بعد</p>
                <a href="/shop" class="shop-now-btn">تسوق الآن</a>
            </div>
        </div>
    </section>
    
    <script src="{{ asset('assets/js/cart.js') }}"></script>
</body>
</html>