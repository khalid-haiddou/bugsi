<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - Bugsi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/dashboard.css') }}">
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
                <h1 class="page-title">مرحباً بك في لوحة التحكم</h1>
                <p class="page-subtitle">نظرة عامة على أداء المتجر والطلبات الجديدة</p>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon blue">💰</div>
                        <div class="stat-trend up">+12.5%</div>
                    </div>
                    <div class="stat-label">إجمالي المبيعات</div>
                    <div class="stat-value">45,280 dhs</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon green">📦</div>
                        <div class="stat-trend up">+8.2%</div>
                    </div>
                    <div class="stat-label">الطلبات الجديدة</div>
                    <div class="stat-value">247</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon orange">🛍️</div>
                        <div class="stat-trend down">-2.4%</div>
                    </div>
                    <div class="stat-label">المنتجات</div>
                    <div class="stat-value">156</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon red">👥</div>
                        <div class="stat-trend up">+15.8%</div>
                    </div>
                    <div class="stat-label">العملاء</div>
                    <div class="stat-value">1,842</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Sales Chart -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">📈 إحصائيات المبيعات</h2>
                        <a href="#" class="card-action">عرض التقرير الكامل ←</a>
                    </div>
                    <div class="chart-container">
                        <div class="chart-bar" style="height: 45%">
                            <span class="chart-value">3,200 dhs</span>
                        </div>
                        <div class="chart-bar" style="height: 65%">
                            <span class="chart-value">4,800 dhs</span>
                        </div>
                        <div class="chart-bar" style="height: 55%">
                            <span class="chart-value">4,100 dhs</span>
                        </div>
                        <div class="chart-bar" style="height: 80%">
                            <span class="chart-value">6,200 dhs</span>
                        </div>
                        <div class="chart-bar" style="height: 70%">
                            <span class="chart-value">5,400 dhs</span>
                        </div>
                        <div class="chart-bar" style="height: 90%">
                            <span class="chart-value">7,100 dhs</span>
                        </div>
                        <div class="chart-bar" style="height: 100%">
                            <span class="chart-value">8,500 dhs</span>
                        </div>
                    </div>
                    <div class="chart-labels">
                        <span class="chart-label">السبت</span>
                        <span class="chart-label">الأحد</span>
                        <span class="chart-label">الإثنين</span>
                        <span class="chart-label">الثلاثاء</span>
                        <span class="chart-label">الأربعاء</span>
                        <span class="chart-label">الخميس</span>
                        <span class="chart-label">الجمعة</span>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">🔔 النشاطات الأخيرة</h2>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon blue">📦</div>
                            <div class="activity-content">
                                <div class="activity-title">طلب جديد</div>
                                <div class="activity-desc">طلب رقم #12847 من محمد أحمد</div>
                                <div class="activity-time">منذ 5 دقائق</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon green">💬</div>
                            <div class="activity-content">
                                <div class="activity-title">رسالة جديدة</div>
                                <div class="activity-desc">استفسار من فاطمة الزهراء</div>
                                <div class="activity-time">منذ 15 دقيقة</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon orange">⚠️</div>
                            <div class="activity-content">
                                <div class="activity-title">تنبيه المخزون</div>
                                <div class="activity-desc">منتج MMS قارب على النفاذ</div>
                                <div class="activity-time">منذ ساعة</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon red">🎫</div>
                            <div class="activity-content">
                                <div class="activity-title">تذكرة دعم جديدة</div>
                                <div class="activity-desc">مشكلة في الدفع - أولوية عالية</div>
                                <div class="activity-time">منذ ساعتين</div>
                            </div>
                        </div>
                    </div>
                    <div class="quick-actions">
                        <button class="action-btn">
                            <span>➕</span>
                            طلب جديد
                        </button>
                        <button class="action-btn">
                            <span>🛍️</span>
                            منتج جديد
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">📦 أحدث الطلبات</h2>
                    <a href="/admin/orders" class="card-action">عرض الكل ←</a>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>رقم الطلب</th>
                                <th>العميل</th>
                                <th>المنتجات</th>
                                <th>المبلغ</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراء</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>#12847</strong></td>
                                <td>محمد أحمد</td>
                                <td>MMS × 2</td>
                                <td><strong>520 dhs</strong></td>
                                <td><span class="status-badge pending">قيد الانتظار</span></td>
                                <td>اليوم، 14:30</td>
                                <td><a href="#" class="card-action">عرض</a></td>
                            </tr>
                            <tr>
                                <td><strong>#12846</strong></td>
                                <td>فاطمة الزهراء</td>
                                <td>CDS × 1</td>
                                <td><strong>220 dhs</strong></td>
                                <td><span class="status-badge confirmed">مؤكد</span></td>
                                <td>اليوم، 12:15</td>
                                <td><a href="#" class="card-action">عرض</a></td>
                            </tr>
                            <tr>
                                <td><strong>#12845</strong></td>
                                <td>عمر الحسني</td>
                                <td>MMS × 1, CDS × 1</td>
                                <td><strong>370 dhs</strong></td>
                                <td><span class="status-badge shipping">قيد الشحن</span></td>
                                <td>أمس، 18:45</td>
                                <td><a href="#" class="card-action">عرض</a></td>
                            </tr>
                            <tr>
                                <td><strong>#12844</strong></td>
                                <td>سارة المنصوري</td>
                                <td>MMS × 3</td>
                                <td><strong>450 dhs</strong></td>
                                <td><span class="status-badge delivered">تم التسليم</span></td>
                                <td>أمس، 16:20</td>
                                <td><a href="#" class="card-action">عرض</a></td>
                            </tr>
                            <tr>
                                <td><strong>#12843</strong></td>
                                <td>خالد بنعلي</td>
                                <td>CDS × 2</td>
                                <td><strong>440 dhs</strong></td>
                                <td><span class="status-badge cancelled">ملغي</span></td>
                                <td>أمس، 10:05</td>
                                <td><a href="#" class="card-action">عرض</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>

</body>
</html>