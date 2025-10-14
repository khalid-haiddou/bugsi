<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسائل التواصل - Bugsi Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/messages.css') }}">
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
                    <h1 class="page-title">رسائل التواصل</h1>
                    <p class="page-subtitle">إدارة والرد على استفسارات ورسائل العملاء</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-secondary" onclick="exportMessages()">
                        <span>📥</span>
                        تصدير
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card active" onclick="filterByStatus('all')">
                    <div class="stat-header">
                        <div class="stat-icon blue">💬</div>
                    </div>
                    <div class="stat-label">جميع الرسائل</div>
                    <div class="stat-value">52</div>
                </div>

                <div class="stat-card" onclick="filterByStatus('new')">
                    <div class="stat-header">
                        <div class="stat-icon blue">📨</div>
                    </div>
                    <div class="stat-label">رسائل جديدة</div>
                    <div class="stat-value">8</div>
                </div>

                <div class="stat-card" onclick="filterByStatus('read')">
                    <div class="stat-header">
                        <div class="stat-icon green">✅</div>
                    </div>
                    <div class="stat-label">مقروءة</div>
                    <div class="stat-value">28</div>
                </div>

                <div class="stat-card" onclick="filterByStatus('replied')">
                    <div class="stat-header">
                        <div class="stat-icon orange">↩️</div>
                    </div>
                    <div class="stat-label">تم الرد عليها</div>
                    <div class="stat-value">16</div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filters-card">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">الحالة</label>
                        <select class="filter-select" id="statusFilter">
                            <option value="">جميع الحالات</option>
                            <option value="new">جديدة</option>
                            <option value="read">مقروءة</option>
                            <option value="replied">تم الرد</option>
                            <option value="archived">مؤرشفة</option>
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
                        <label class="filter-label">الترتيب</label>
                        <select class="filter-select" id="sortFilter">
                            <option value="newest">الأحدث أولاً</option>
                            <option value="oldest">الأقدم أولاً</option>
                            <option value="unread">غير المقروءة</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Messages Table -->
            <div class="messages-card">
                <div class="card-header">
                    <h2 class="card-title">قائمة الرسائل</h2>
                    <div class="bulk-actions">
                        <select class="bulk-select">
                            <option value="">إجراءات جماعية</option>
                            <option value="read">تعليم كمقروءة</option>
                            <option value="unread">تعليم كغير مقروءة</option>
                            <option value="archive">أرشفة</option>
                            <option value="delete">حذف</option>
                        </select>
                        <button class="btn btn-secondary" style="padding: 8px 16px; font-size: 13px;">تطبيق</button>
                    </div>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkbox" id="selectAll"></th>
                                <th>المرسل</th>
                                <th>الموضوع</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="messagesTableBody">
                            <!-- Messages will be inserted here -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination-info">
                        عرض <strong>1-10</strong> من <strong>52</strong> رسالة
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

    <!-- Message Details Modal -->
    <div class="modal" id="messageModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">تفاصيل الرسالة</h2>
                <button class="close-btn" onclick="closeMessageModal()">×</button>
            </div>

            <div class="message-details">
                <div class="detail-row">
                    <span class="detail-label">المرسل</span>
                    <span class="detail-value" id="modalSenderName">محمد الكريم</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">البريد الإلكتروني</span>
                    <span class="detail-value" id="modalSenderEmail">mohamed@example.com</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">الموضوع</span>
                    <span class="detail-value" id="modalSubject">استفسار عن المنتج</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">التاريخ</span>
                    <span class="detail-value" id="modalDate">اليوم، 14:30</span>
                </div>
            </div>

            <div class="message-content">
                <div class="message-content-title">📩 محتوى الرسالة</div>
                <div class="message-text" id="modalMessageText">
                    مرحباً، أود الاستفسار عن منتج MMS وكيفية استخدامه...
                </div>
            </div>

            <div class="reply-section">
                <div class="reply-title">↩️ الرد على الرسالة</div>
                <textarea class="reply-textarea" id="replyText" placeholder="اكتب ردك هنا..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">تغيير حالة الرسالة</label>
                <select class="form-select" id="messageStatusSelect">
                    <option value="new">جديدة</option>
                    <option value="read">مقروءة</option>
                    <option value="replied">تم الرد</option>
                    <option value="archived">مؤرشفة</option>
                </select>
            </div>

            <div class="modal-actions">
                <button class="btn btn-secondary" onclick="closeMessageModal()">
                    إغلاق
                </button>
                <button class="btn btn-primary" onclick="sendReply()">
                    <span>📧</span>
                    إرسال الرد
                </button>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/admin/messages.js') }}"></script>
</body>
</html>