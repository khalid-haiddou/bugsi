<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="إتمام الطلب - Bugsi">
    <title>إتمام الطلب - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
</head>
<body>
    @include('layouts.header')
    <!-- Checkout Section -->
    <section class="checkout-section">
        <div class="container">
            <div class="checkout-container">
                <!-- Billing Form -->
                <div>
                    <div class="billing-section">
                        <h2 class="section-title">
                            <span>📍</span>
                            معلومات الشحن
                        </h2>

                        <form id="checkoutForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        الاسم الأول <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-input" 
                                        name="first_name"
                                        placeholder="أدخل اسمك الأول"
                                        required
                                    >
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        الاسم الأخير <span class="required">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-input" 
                                        name="last_name"
                                        placeholder="أدخل اسمك الأخير"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    رقم الهاتف <span class="required">*</span>
                                </label>
                                <input 
                                    type="tel" 
                                    class="form-input" 
                                    name="phone"
                                    id="phone"
                                    placeholder="+212 XXX-XXXXXX"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    المدينة <span class="required">*</span>
                                </label>
                                <select class="form-select" name="city" required>
                                    <option value="">اختر المدينة</option>
                                    <option value="casablanca">الدار البيضاء</option>
                                    <option value="rabat">الرباط</option>
                                    <option value="fes">فاس</option>
                                    <option value="marrakech">مراكش</option>
                                    <option value="tangier">طنجة</option>
                                    <option value="agadir">أكادير</option>
                                    <option value="meknes">مكناس</option>
                                    <option value="oujda">وجدة</option>
                                    <option value="kenitra">القنيطرة</option>
                                    <option value="tetouan">تطوان</option>
                                    <option value="other">مدينة أخرى</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    العنوان الكامل <span class="required">*</span>
                                </label>
                                <textarea 
                                    class="form-textarea" 
                                    name="address"
                                    placeholder="أدخل عنوانك بالتفصيل (الشارع، الحي، رقم المنزل...)"
                                    required
                                ></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label">ملاحظات إضافية (اختياري)</label>
                                <textarea 
                                    class="form-textarea" 
                                    name="notes"
                                    placeholder="أي تعليمات أو ملاحظات خاصة بالتوصيل"
                                    style="min-height: 80px;"
                                ></textarea>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Method -->
                    <div class="payment-section">
                        <h2 class="section-title">
                            <span>💳</span>
                            طريقة الدفع
                        </h2>

                        <div class="payment-method">
                            <div class="payment-icon">💵</div>
                            <div class="payment-info">
                                <h3>الدفع عند الاستلام</h3>
                                <p>ادفع نقداً عند استلام طلبك من المندوب</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="order-summary">
                    <div class="summary-card">
                        <h3 class="summary-title">ملخص الطلب</h3>

                        <!-- Cart Items -->
                        <div class="cart-items">
                            <div class="cart-item">
                                <div class="item-image">
                                    <img src="https://via.placeholder.com/150x150/0e9eff/ffffff?text=MMS" alt="MMS">
                                </div>
                                <div class="item-details">
                                    <div class="item-name">MMS - محلول معدني معجزة</div>
                                    <div class="item-quantity">الكمية: 2</div>
                                    <div class="item-price">300 dhs</div>
                                </div>
                            </div>

                            <div class="cart-item">
                                <div class="item-image">
                                    <img src="https://via.placeholder.com/150x150/00d2d3/ffffff?text=CDS" alt="CDS">
                                </div>
                                <div class="item-details">
                                    <div class="item-name">CDS - محلول الكلور المركز</div>
                                    <div class="item-quantity">الكمية: 1</div>
                                    <div class="item-price">220 dhs</div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Notice -->
                        <div class="shipping-notice" id="shippingNotice">
                            <div class="shipping-notice-icon">✓</div>
                            <div class="shipping-notice-text">
                                <strong>مبروك!</strong> حصلت على شحن مجاني
                            </div>
                        </div>

                        <!-- Summary Totals -->
                        <div class="summary-row">
                            <span class="summary-label">المجموع الفرعي</span>
                            <span class="summary-value" id="subtotal">520 dhs</span>
                        </div>

                        <div class="summary-row shipping">
                            <span class="summary-label">رسوم الشحن</span>
                            <span class="summary-value" id="shipping">مجاناً</span>
                        </div>

                        <div class="summary-row total">
                            <span class="summary-label">الإجمالي</span>
                            <span class="summary-value" id="total">520 dhs</span>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="submit-btn" id="submitBtn" form="checkoutForm">
                            تأكيد الطلب
                        </button>

                        <div class="secure-text">
                            <span>🔒</span>
                            معاملة آمنة ومحمية
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/js/checkout.js') }}"></script>
</body>
</html>