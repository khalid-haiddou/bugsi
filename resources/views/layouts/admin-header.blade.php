<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/admin-header.css') }}">
</head>

<body>
    <!-- resources/views/admin/header.blade.php -->
<header class="header">
    <div class="header-right">
        <button class="icon-btn menu-toggle" onclick="toggleSidebar()">
            <span>☰</span>
        </button>

        <div class="search-box">
            <span>🔍</span>
            <input type="text" placeholder="ابحث هنا...">
        </div>
    </div>

    <div class="header-actions">
        <button class="icon-btn" title="الإشعارات">
            <span>🔔</span>
            <span class="badge">7</span>
        </button>

        <button class="icon-btn" title="الرسائل">
            <span>✉️</span>
            <span class="badge">3</span>
        </button>

        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">أحمد المدير</div>
                <div class="user-role">مدير النظام</div>
            </div>
            <div class="user-avatar">AM</div>
        </div>
    </div>
</header>

</body>
</html>