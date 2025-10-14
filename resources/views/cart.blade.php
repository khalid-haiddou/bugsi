<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="سلة التسوق - Bugsi">
    <title>سلة التسوق - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>
    
    <!-- Cart Section -->
    <section class="cart-section">
        <div class="container">
            <h1 class="page-title">سلة التسوق</h1>
            <p class="page-subtitle">لديك <span id="itemCount">3</span> منتجات في سلتك</p>

            <div id="successMessage" class="success-message">
                <span>✓</span>
                <span>تم تطبيق كود الخصم بنجاح!</span>
            </div>

            <div class="cart-layout" id="cartLayout">
                <!-- Cart Items -->
                <div class="cart-items" id="cartItems">
                    <div class="cart-item" data-id="1" data-price="150">
                        <div class="item-image">
                            <img src="https://via.placeholder.com/120x120/0e9eff/ffffff?text=MMS" alt="MMS">
                        </div>
                        <div class="item-details">
                            <div>
                                <h3 class="item-name">MMS - محلول معدني معجزة</h3>
                                <p class="item-category">MMS</p>
                            </div>
                            <div class="item-controls">
                                <div class="quantity-controls">
                                    <button class="quantity-btn decrease-qty">-</button>
                                    <input type="number" class="quantity-input" value="2" min="1" max="10" readonly>
                                    <button class="quantity-btn increase-qty">+</button>
                                </div>
                                <button class="remove-btn">
                                    <span>🗑️</span>
                                    حذف
                                </button>
                            </div>
                        </div>
                        <div class="item-pricing">
                            <div class="item-price">150 dhs</div>
                            <div class="item-total">المجموع: <span class="item-subtotal">300</span> dhs</div>
                        </div>
                    </div>

                    <div class="cart-item" data-id="2" data-price="220">
                        <div class="item-image">
                            <img src="https://via.placeholder.com/120x120/00d2d3/ffffff?text=CDS" alt="CDS">
                        </div>
                        <div class="item-details">
                            <div>
                                <h3 class="item-name">CDS - محلول الكلور المركز</h3>
                                <p class="item-category">CDS</p>
                            </div>
                            <div class="item-controls">
                                <div class="quantity-controls">
                                    <button class="quantity-btn decrease-qty">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10" readonly>
                                    <button class="quantity-btn increase-qty">+</button>
                                </div>
                                <button class="remove-btn">
                                    <span>🗑️</span>
                                    حذف
                                </button>
                            </div>
                        </div>
                        <div class="item-pricing">
                            <div class="item-price">220 dhs</div>
                            <div class="item-total">المجموع: <span class="item-subtotal">220</span> dhs</div>
                        </div>
                    </div>

                    <div class="cart-item" data-id="3" data-price="180">
                        <div class="item-image">
                            <img src="https://via.placeholder.com/120x120/ff6348/ffffff?text=DMSO" alt="DMSO">
                        </div>
                        <div class="item-details">
                            <div>
                                <h3 class="item-name">DMSO - ديميثيل سلفوكسيد</h3>
                                <p class="item-category">DMSO</p>
                            </div>
                            <div class="item-controls">
                                <div class="quantity-controls">
                                    <button class="quantity-btn decrease-qty">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1" max="10" readonly>
                                    <button class="quantity-btn increase-qty">+</button>
                                </div>
                                <button class="remove-btn">
                                    <span>🗑️</span>
                                    حذف
                                </button>
                            </div>
                        </div>
                        <div class="item-pricing">
                            <div class="item-price">180 dhs</div>
                            <div class="item-total">المجموع: <span class="item-subtotal">180</span> dhs</div>
                        </div>
                    </div>
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
                        <span class="summary-value" id="subtotal">700 dhs</span>
                    </div>

                    <div class="summary-row" id="discountRow" style="display: none;">
                        <span class="summary-label">الخصم:</span>
                        <span class="summary-value" style="color: var(--success);" id="discount">-0 dhs</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">الشحن:</span>
                        <span class="summary-value" id="shipping">مجاني</span>
                    </div>

                    <div class="summary-total">
                        <div class="summary-row">
                            <span class="summary-label">الإجمالي:</span>
                            <span class="summary-value" id="total">700 dhs</span>
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

            <!-- Empty Cart (Hidden by default) -->
            <div class="empty-cart" id="emptyCart" style="display: none;">
                <div class="empty-icon">🛒</div>
                <h2 class="empty-title">سلة التسوق فارغة</h2>
                <p class="empty-text">لم تقم بإضافة أي منتجات بعد</p>
                <a href="#" class="shop-now-btn">تسوق الآن</a>
            </div>
        </div>
    </section>


</body>
</html>