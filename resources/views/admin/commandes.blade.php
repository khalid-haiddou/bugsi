<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الطلبات - Bugsi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/commandes.css') }}">
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
                    <h1 class="page-title">إدارة الطلبات</h1>
                    <p class="page-subtitle">عرض وإدارة جميع الطلبات في المتجر</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-secondary" onclick="exportOrders()">
                        <span>📥</span>
                        تصدير Excel
                    </button>
                    <button class="btn btn-primary" onclick="createOrder()">
                        <span>➕</span>
                        طلب جديد
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card active" onclick="filterByStatus('all')">
                    <div class="stat-header">
                        <span class="stat-icon">📦</span>
                    </div>
                    <div class="stat-label">جميع الطلبات</div>
                    <div class="stat-value">247</div>
                </div>

                <div class="stat-card" onclick="filterByStatus('pending')">
                    <div class="stat-header">
                        <span class="stat-icon">⏳</span>
                    </div>
                    <div class="stat-label">قيد الانتظار</div>
                    <div class="stat-value">12</div>
                </div>

                <div class="stat-card" onclick="filterByStatus('shipping')">
                    <div class="stat-header">
                        <span class="stat-icon">🚚</span>
                    </div>
                    <div class="stat-label">قيد الشحن</div>
                    <div class="stat-value">34</div>
                </div>

                <div class="stat-card" onclick="filterByStatus('delivered')">
                    <div class="stat-header">
                        <span class="stat-icon">✅</span>
                    </div>
                    <div class="stat-label">تم التسليم</div>
                    <div class="stat-value">189</div>
                </div>

                <div class="stat-card" onclick="filterByStatus('cancelled')">
                    <div class="stat-header">
                        <span class="stat-icon">❌</span>
                    </div>
                    <div class="stat-label">ملغية</div>
                    <div class="stat-value">12</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-card">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">الحالة</label>
                        <select class="filter-select" id="statusFilter">
                            <option value="">جميع الحالات</option>
                            <option value="pending">قيد الانتظار</option>
                            <option value="confirmed">مؤكد</option>
                            <option value="shipping">قيد الشحن</option>
                            <option value="delivered">تم التسليم</option>
                            <option value="cancelled">ملغي</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">التاريخ من</label>
                        <input type="date" class="filter-input" id="dateFrom">
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">التاريخ إلى</label>
                        <input type="date" class="filter-input" id="dateTo">
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
                </div>
            </div>

            <!-- Orders Table -->
            <div class="orders-card">
                <div class="card-header">
                    <h2 class="card-title">قائمة الطلبات</h2>
                    <div class="bulk-actions">
                        <select class="bulk-select">
                            <option value="">إجراءات جماعية</option>
                            <option value="confirm">تأكيد المحدد</option>
                            <option value="ship">شحن المحدد</option>
                            <option value="delete">حذف المحدد</option>
                        </select>
                        <button class="btn btn-secondary" style="padding: 8px 16px; font-size: 13px;">تطبيق</button>
                    </div>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkbox" id="selectAll"></th>
                                <th>رقم الطلب</th>
                                <th>العميل</th>
                                <th>المنتجات</th>
                                <th>المدينة</th>
                                <th>المبلغ</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTableBody">
                            <!-- Order rows will be inserted here by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination-info">
                        عرض <strong>1-15</strong> من <strong>247</strong> طلب
                    </div>
                    <div class="pagination-buttons">
                        <button class="page-btn" disabled>«</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">5</button>
                        <button class="page-btn">»</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Order Details Modal -->
    <div class="modal" id="orderModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">تفاصيل الطلب #<span id="modalOrderId"></span></h2>
                <button class="close-btn" onclick="closeModal()">×</button>
            </div>

            <div class="order-details">
                <div class="detail-group">
                    <div class="detail-label">معلومات العميل</div>
                    <div class="customer-info" style="margin-top: 12px;">
                        <div class="customer-avatar" id="modalCustomerAvatar">MK</div>
                        <div class="customer-details">
                            <div class="customer-name" id="modalCustomerName">محمد الكريم</div>
                            <div class="customer-phone" id="modalCustomerPhone">+212 XXX-XXXXXX</div>
                        </div>
                    </div>
                </div>

                <div class="detail-group">
                    <div class="detail-label">العنوان</div>
                    <div class="detail-value" id="modalAddress">شارع محمد الخامس، حي المعاريف، الدار البيضاء</div>
                </div>

                <div class="detail-group">
                    <div class="detail-label">المنتجات المطلوبة</div>
                    <div class="products-list" id="modalProducts">
                        <!-- Products will be inserted here -->
                    </div>
                </div>

                <div class="detail-group">
                    <div class="detail-label">ملخص الطلب</div>
                    <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                        <span>المجموع الفرعي:</span>
                        <strong id="modalSubtotal">520 dhs</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 8px;">
                        <span>رسوم الشحن:</span>
                        <strong id="modalShipping" style="color: var(--success);">مجاناً</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 12px; padding-top: 12px; border-top: 2px solid #e0e0e0;">
                        <span style="font-weight: 800;">الإجمالي:</span>
                        <strong id="modalTotal" style="font-size: 20px; color: var(--primary-color);">520 dhs</strong>
                    </div>
                </div>

                <div class="detail-group">
                    <div class="detail-label">تغيير حالة الطلب</div>
                    <select class="filter-select" id="modalStatusSelect" style="margin-top: 10px;">
                        <option value="pending">قيد الانتظار</option>
                        <option value="confirmed">مؤكد</option>
                        <option value="shipping">قيد الشحن</option>
                        <option value="delivered">تم التسليم</option>
                        <option value="cancelled">ملغي</option>
                    </select>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 20px;">
                    <button class="btn btn-primary" style="flex: 1;" onclick="updateOrderStatus()">
                        <span>💾</span>
                        حفظ التغييرات
                    </button>
                    <button class="btn btn-secondary" style="flex: 1;" onclick="printOrder()">
                        <span>🖨️</span>
                        طباعة
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/admin/commandes.js') }}"></script>
</body>
</html>