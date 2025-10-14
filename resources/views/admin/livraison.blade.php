<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الشحن - Bugsi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/livraison.css') }}">
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
                    <h1 class="page-title">إدارة الشحن</h1>
                    <p class="page-subtitle">تتبع وإدارة جميع الشحنات في الوقت الفعلي</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-secondary" onclick="exportShipments()">
                        <span>📥</span>
                        تصدير التقرير
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon blue">🚚</div>
                    </div>
                    <div class="stat-label">قيد الشحن</div>
                    <div class="stat-value">34</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon green">✅</div>
                    </div>
                    <div class="stat-label">تم التسليم اليوم</div>
                    <div class="stat-value">18</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon orange">⏱️</div>
                    </div>
                    <div class="stat-label">متوسط وقت التسليم</div>
                    <div class="stat-value" style="font-size: 20px;">2.5 يوم</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon red">⚠️</div>
                    </div>
                    <div class="stat-label">شحنات متأخرة</div>
                    <div class="stat-value">3</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-card">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">الحالة</label>
                        <select class="filter-select" id="statusFilter">
                            <option value="">جميع الحالات</option>
                            <option value="preparing">قيد التحضير</option>
                            <option value="in-transit">في الطريق</option>
                            <option value="out-for-delivery">خارج للتوصيل</option>
                            <option value="delivered">تم التسليم</option>
                            <option value="delayed">متأخر</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">المدينة</label>
                        <select class="filter-select" id="cityFilter">
                            <option value="">جميع المدن</option>
                            <option value="casablanca">الدار البيضاء</option>
                            <option value="rabat">الرباط</option>
                            <option value="marrakech">مراكش</option>
                            <option value="fes">فاس</option>
                            <option value="tangier">طنجة</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">شركة الشحن</label>
                        <select class="filter-select" id="companyFilter">
                            <option value="">جميع الشركات</option>
                            <option value="amana">أمانة</option>
                            <option value="ctm">CTM</option>
                            <option value="dhl">DHL Express</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">التاريخ</label>
                        <input type="date" class="filter-input" id="dateFilter">
                    </div>
                </div>
            </div>

            <!-- Shipments Table -->
            <div class="shipments-card">
                <div class="card-header">
                    <h2 class="card-title">قائمة الشحنات</h2>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>رقم التتبع</th>
                                <th>الطلب</th>
                                <th>العميل</th>
                                <th>المدينة</th>
                                <th>شركة الشحن</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="shipmentsTableBody">
                            <!-- Shipments will be inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Shipping Companies -->
            <div class="shipments-card">
                <div class="card-header">
                    <h2 class="card-title">شركات الشحن المتعاونة</h2>
                </div>

                <div class="companies-grid">
                    <div class="company-card">
                        <div class="company-icon">🚚</div>
                        <div class="company-info">
                            <div class="company-name">أمانة</div>
                            <div class="company-shipments">45 شحنة نشطة</div>
                        </div>
                    </div>

                    <div class="company-card">
                        <div class="company-icon">📦</div>
                        <div class="company-info">
                            <div class="company-name">CTM</div>
                            <div class="company-shipments">32 شحنة نشطة</div>
                        </div>
                    </div>

                    <div class="company-card">
                        <div class="company-icon">✈️</div>
                        <div class="company-info">
                            <div class="company-name">DHL Express</div>
                            <div class="company-shipments">12 شحنة نشطة</div>
                        </div>
                    </div>

                    <div class="company-card">
                        <div class="company-icon">🚛</div>
                        <div class="company-info">
                            <div class="company-name">Colis Privé</div>
                            <div class="company-shipments">8 شحنات نشطة</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Tracking Details Modal -->
    <div class="modal" id="trackingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">تتبع الشحنة #<span id="modalTrackingNumber"></span></h2>
                <button class="close-btn" onclick="closeTrackingModal()">×</button>
            </div>

            <div class="form-group">
                <label class="form-label">رقم التتبع</label>
                <input type="text" class="form-input" id="trackingNumberInput" placeholder="TRK-2025-XXX">
            </div>

            <div class="detail-group">
                <div class="detail-label">رقم الطلب</div>
                <div class="detail-value" id="modalOrderNumber">#12847</div>
            </div>

            <div class="detail-group">
                <div class="detail-label">معلومات العميل</div>
                <div class="detail-value" id="modalCustomer">محمد الكريم - +212 6XX-XXXXXX</div>
            </div>

            <div class="detail-group">
                <div class="detail-label">عنوان التوصيل</div>
                <div class="detail-value" id="modalAddress">شارع محمد الخامس، حي المعاريف، الدار البيضاء</div>
            </div>

            <div class="form-group">
                <label class="form-label">شركة الشحن</label>
                <select class="form-select" id="shippingCompanySelect">
                    <option value="أمانة">أمانة 🚚</option>
                    <option value="CTM">CTM 📦</option>
                    <option value="DHL Express">DHL Express ✈️</option>
                    <option value="Colis Privé">Colis Privé 🚛</option>
                </select>
            </div>

            <div class="detail-group">
                <div class="detail-label">تاريخ تتبع الشحنة</div>
                <div class="timeline" id="trackingTimeline">
                    <!-- Timeline will be inserted here -->
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">تحديث حالة الشحن</label>
                <select class="form-select" id="updateStatusSelect">
                    <option value="preparing">قيد التحضير</option>
                    <option value="in-transit">في الطريق</option>
                    <option value="out-for-delivery">خارج للتوصيل</option>
                    <option value="delivered">تم التسليم</option>
                    <option value="delayed">متأخر</option>
                </select>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 20px;">
                <button class="btn btn-primary" style="flex: 1;" onclick="updateShipmentStatus()">
                    <span>💾</span>
                    تحديث الحالة
                </button>
                <button class="btn btn-secondary" style="flex: 1;" onclick="printShipment()">
                    <span>🖨️</span>
                    طباعة
                </button>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/admin/livraison.js') }}"></script>
</body>
</html>