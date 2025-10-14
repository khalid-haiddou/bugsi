<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الإحصائيات - Bugsi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/statistic.css') }}">
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
                <div class="page-title-section">
                    <h1 class="page-title">الإحصائيات والتقارير</h1>
                    <p class="page-subtitle">تحليلات مفصلة لأداء المتجر والمبيعات</p>
                </div>
                <div class="page-actions">
                    <div class="period-selector">
                        <button class="period-btn" onclick="changePeriod('today')">اليوم</button>
                        <button class="period-btn active" onclick="changePeriod('week')">هذا الأسبوع</button>
                        <button class="period-btn" onclick="changePeriod('month')">هذا الشهر</button>
                        <button class="period-btn" onclick="changePeriod('year')">هذه السنة</button>
                    </div>
                    <button class="btn btn-primary" onclick="exportReport()">
                        <span>📥</span>
                        تصدير التقرير
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon blue">💰</div>
                        <div class="stat-trend up">+12.5%</div>
                    </div>
                    <div class="stat-label">إجمالي الإيرادات</div>
                    <div class="stat-value">45,280 dhs</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon green">📦</div>
                        <div class="stat-trend up">+8.2%</div>
                    </div>
                    <div class="stat-label">عدد الطلبات</div>
                    <div class="stat-value">247</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon orange">📊</div>
                        <div class="stat-trend up">+5.7%</div>
                    </div>
                    <div class="stat-label">متوسط قيمة الطلب</div>
                    <div class="stat-value">183 dhs</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon purple">👥</div>
                        <div class="stat-trend up">+15.8%</div>
                    </div>
                    <div class="stat-label">عملاء جدد</div>
                    <div class="stat-value">142</div>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">📈 إحصائيات المبيعات اليومية</h2>
                </div>
                <div class="chart-container" id="salesChart">
                    <!-- Chart will be inserted here -->
                </div>
                <div class="chart-labels" id="chartLabels">
                    <!-- Labels will be inserted here -->
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Top Products -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">🏆 المنتجات الأكثر مبيعاً</h2>
                    </div>
                    <div class="products-list">
                        <div class="product-item">
                            <div class="product-rank">1</div>
                            <div class="product-info">
                                <div class="product-name">MMS - محلول معدني معجزة</div>
                                <div class="product-sales">125 عملية بيع</div>
                            </div>
                            <div class="product-revenue">18,750 dhs</div>
                        </div>

                        <div class="product-item">
                            <div class="product-rank">2</div>
                            <div class="product-info">
                                <div class="product-name">CDS - محلول الكلور المركز</div>
                                <div class="product-sales">98 عملية بيع</div>
                            </div>
                            <div class="product-revenue">21,560 dhs</div>
                        </div>

                        <div class="product-item">
                            <div class="product-rank">3</div>
                            <div class="product-info">
                                <div class="product-name">فيتامين سي المركز</div>
                                <div class="product-sales">76 عملية بيع</div>
                            </div>
                            <div class="product-revenue">13,680 dhs</div>
                        </div>

                        <div class="product-item">
                            <div class="product-rank">4</div>
                            <div class="product-info">
                                <div class="product-name">زيت الأرغان المغربي</div>
                                <div class="product-sales">54 عملية بيع</div>
                            </div>
                            <div class="product-revenue">6,480 dhs</div>
                        </div>

                        <div class="product-item">
                            <div class="product-rank">5</div>
                            <div class="product-info">
                                <div class="product-name">مكمل الأوميغا 3</div>
                                <div class="product-sales">42 عملية بيع</div>
                            </div>
                            <div class="product-revenue">8,400 dhs</div>
                        </div>
                    </div>
                </div>

                <!-- Cities Stats -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">🌍 الطلبات حسب المدن</h2>
                    </div>
                    <div class="cities-list">
                        <div class="city-item">
                            <div class="city-name">الدار البيضاء</div>
                            <div class="city-bar-container">
                                <div class="city-bar" style="width: 45%;">
                                    <span class="city-percentage">45%</span>
                                </div>
                            </div>
                            <div class="city-orders">112 طلب</div>
                        </div>

                        <div class="city-item">
                            <div class="city-name">الرباط</div>
                            <div class="city-bar-container">
                                <div class="city-bar" style="width: 28%;">
                                    <span class="city-percentage">28%</span>
                                </div>
                            </div>
                            <div class="city-orders">69 طلب</div>
                        </div>

                        <div class="city-item">
                            <div class="city-name">مراكش</div>
                            <div class="city-bar-container">
                                <div class="city-bar" style="width: 15%;">
                                    <span class="city-percentage">15%</span>
                                </div>
                            </div>
                            <div class="city-orders">37 طلب</div>
                        </div>

                        <div class="city-item">
                            <div class="city-name">فاس</div>
                            <div class="city-bar-container">
                                <div class="city-bar" style="width: 8%;">
                                    <span class="city-percentage">8%</span>
                                </div>
                            </div>
                            <div class="city-orders">20 طلب</div>
                        </div>

                        <div class="city-item">
                            <div class="city-name">طنجة</div>
                            <div class="city-bar-container">
                                <div class="city-bar" style="width: 4%;">
                                    <span class="city-percentage">4%</span>
                                </div>
                            </div>
                            <div class="city-orders">9 طلبات</div>
                        </div>
                    </div>

                    <div class="summary-grid" style="margin-top: 20px;">
                        <div class="summary-card">
                            <div class="summary-label">إجمالي الطلبات</div>
                            <div class="summary-value">247</div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-label">عدد المدن</div>
                            <div class="summary-value">12</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Stats -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">📊 إحصائيات إضافية</h2>
                </div>
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="summary-label">معدل التحويل</div>
                        <div class="summary-value">3.2%</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">معدل إلغاء الطلبات</div>
                        <div class="summary-value">4.8%</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">الزيارات اليومية</div>
                        <div class="summary-value">2,847</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">متوسط وقت التصفح</div>
                        <div class="summary-value">4:32</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/js/admin/statistic.js') }}"></script>

</body>
</html>