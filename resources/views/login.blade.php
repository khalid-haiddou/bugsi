<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="تسجيل الدخول - Bugsi">
    <title>تسجيل الدخول - Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">BUGSI</div>
        </div>

        <div class="login-body">
            <div class="welcome-text">
                <h2>مرحباً بعودتك!</h2>
                <p>سجل الدخول للوصول إلى حسابك</p>
            </div>

            <form id="loginForm">
                <div class="form-group">
                    <label class="form-label" for="email">البريد الإلكتروني</label>
                    <div class="form-input-wrapper">
                        <input 
                            type="email" 
                            id="email" 
                            class="form-input" 
                            placeholder="أدخل بريدك الإلكتروني"
                            required
                        >
                        <span class="input-icon">📧</span>
                    </div>
                    <div class="error-message" id="emailError">البريد الإلكتروني غير صالح</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">كلمة المرور</label>
                    <div class="form-input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            class="form-input" 
                            placeholder="أدخل كلمة المرور"
                            required
                        >
                        <button type="button" class="toggle-password" id="togglePassword">
                            👁️
                        </button>
                    </div>
                    <div class="error-message" id="passwordError">كلمة المرور يجب أن تكون 6 أحرف على الأقل</div>
                </div>

                <div class="form-options">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="remember">
                        <label for="remember">تذكرني</label>
                    </div>
                    <a href="#" class="forgot-password">نسيت كلمة المرور؟</a>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">
                    تسجيل الدخول
                </button>
            </form>

            <div class="signup-link">
                ليس لديك حساب؟ <a href="#">سجل الآن</a>
            </div>
        </div>
    </div>


</body>
</html>