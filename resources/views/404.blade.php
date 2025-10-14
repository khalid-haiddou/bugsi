<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="الصفحة غير موجودة - Bugsi">
    <title>404 - الصفحة غير موجودة | Bugsi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/404.css') }}">
</head>
<body>
    @include('layouts.header')
    <div class="container">
        <div class="error-section">
            <!-- 404 Number -->
            <div class="error-number">404</div>

            <!-- Icon -->
            <div class="icon-container">
                <div class="error-icon">🔍</div>
            </div>

            <!-- Text Content -->
            <h1 class="error-title">عذراً، الصفحة غير موجودة</h1>
            <p class="error-message">
                يبدو أن الصفحة التي تبحث عنها قد تم نقلها أو حذفها أو ربما لم تكن موجودة أصلاً
            </p>
            <p class="error-suggestion">
                يمكنك البحث عن المنتجات أو العودة إلى الصفحة الرئيسية
            </p>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="/" class="btn btn-primary">
                    <span>🏠</span>
                    العودة للرئيسية
                </a>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/404.js') }}"></script>
</body>
</html>