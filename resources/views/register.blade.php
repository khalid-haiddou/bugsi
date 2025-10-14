<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="إنشاء حساب جديد - Bugsi">
    <title>إنشاء حساب - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <div class="logo">Bugsi</div>
            <h1>إنشاء حساب جديد</h1>
            <p>انضم إلينا وابدأ رحلتك نحو الصحة الطبيعية</p>
        </div>

        <form class="register-form" id="registerForm">
            <!-- Full Name -->
            <div class="form-group">
                <label class="form-label">
                    الاسم الكامل <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                    <input 
                        type="text" 
                        class="form-input" 
                        id="fullName" 
                        name="name"
                        placeholder="أدخل اسمك الكامل"
                        required
                    >
                    <span class="input-icon">👤</span>
                </div>
                <div class="error-message" id="nameError">يرجى إدخال الاسم الكامل</div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label">
                    البريد الإلكتروني <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                    <input 
                        type="email" 
                        class="form-input" 
                        id="email" 
                        name="email"
                        placeholder="example@email.com"
                        required
                    >
                    <span class="input-icon">📧</span>
                </div>
                <div class="error-message" id="emailError">يرجى إدخال بريد إلكتروني صحيح</div>
                <div class="success-message" id="emailSuccess">✓ البريد الإلكتروني صحيح</div>
            </div>
            <!-- Password -->
            <div class="form-group">
                <label class="form-label">
                    كلمة المرور <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                    <input 
                        type="password" 
                        class="form-input" 
                        id="password" 
                        name="password"
                        placeholder="أدخل كلمة مرور قوية"
                        required
                    >
                    <button type="button" class="password-toggle" id="togglePassword">👁️</button>
                </div>
                <div class="password-strength">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <div class="strength-text" id="strengthText"></div>
                </div>
                <div class="error-message" id="passwordError">كلمة المرور يجب أن تحتوي على 8 أحرف على الأقل</div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label class="form-label">
                    تأكيد كلمة المرور <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                    <input 
                        type="password" 
                        class="form-input" 
                        id="confirmPassword" 
                        name="password_confirmation"
                        placeholder="أعد إدخال كلمة المرور"
                        required
                    >
                    <button type="button" class="password-toggle" id="toggleConfirmPassword">👁️</button>
                </div>
                <div class="error-message" id="confirmPasswordError">كلمة المرور غير متطابقة</div>
                <div class="success-message" id="confirmPasswordSuccess">✓ كلمة المرور متطابقة</div>
            </div>

            <!-- Terms and Conditions -->
            <div class="checkbox-group">
                <input 
                    type="checkbox" 
                    class="checkbox-input" 
                    id="terms" 
                    name="terms"
                    required
                >
                <label class="checkbox-label" for="terms">
                    أوافق على <a href="/terms">الشروط والأحكام</a> و <a href="/privacy">سياسة الخصوصية</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn" id="submitBtn">
                إنشاء الحساب
            </button>

        </form>
    </div>

    <!-- Success Modal -->
    <div class="success-modal" id="successModal">
        <div class="modal-content">
            <div class="success-icon">✓</div>
            <h2>تم إنشاء الحساب بنجاح!</h2>
            <p>مرحباً بك في Bugsi. يمكنك الآن البدء في التسوق</p>
            <button class="modal-btn" id="continueBtn">ابدأ التسوق</button>
        </div>
    </div>


</body>
</html>