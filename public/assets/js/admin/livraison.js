        // Sample shipments data
        const shipmentsData = [
            {
                trackingNumber: 'TRK-2025-001',
                orderId: '12847',
                customer: 'محمد الكريم',
                phone: '+212 6XX-XXXXXX',
                city: 'الدار البيضاء',
                address: 'شارع محمد الخامس، حي المعاريف، الدار البيضاء',
                company: 'أمانة',
                status: 'in-transit',
                date: 'اليوم، 09:30',
                timeline: [
                    { status: 'completed', title: 'تم إنشاء الشحنة', desc: 'تم تسجيل الطلب في النظام', time: 'اليوم، 08:00' },
                    { status: 'completed', title: 'تم تحضير الطلب', desc: 'تم تجهيز المنتجات للشحن', time: 'اليوم، 08:45' },
                    { status: 'active', title: 'في الطريق', desc: 'الشحنة في طريقها إلى العميل', time: 'اليوم، 09:30' },
                    { status: 'pending', title: 'خارج للتوصيل', desc: 'سيتم التوصيل قريباً', time: '' },
                    { status: 'pending', title: 'تم التسليم', desc: 'تم استلام الطلب', time: '' }
                ]
            },
            {
                trackingNumber: 'TRK-2025-002',
                orderId: '12846',
                customer: 'فاطمة الزهراء',
                phone: '+212 6XX-XXXXXX',
                city: 'الرباط',
                address: 'شارع الحسن الثاني، أكدال، الرباط',
                company: 'CTM',
                status: 'out-for-delivery',
                date: 'اليوم، 11:00',
                timeline: []
            },
            {
                trackingNumber: 'TRK-2025-003',
                orderId: '12845',
                customer: 'عمر الحسني',
                phone: '+212 6XX-XXXXXX',
                city: 'مراكش',
                address: 'شارع محمد السادس، جليز، مراكش',
                company: 'DHL Express',
                status: 'delivered',
                date: 'أمس، 16:30',
                timeline: []
            },
            {
                trackingNumber: 'TRK-2025-004',
                orderId: '12844',
                customer: 'سارة المنصوري',
                phone: '+212 6XX-XXXXXX',
                city: 'فاس',
                address: 'شارع الحسن الثاني، المدينة الجديدة، فاس',
                company: 'أمانة',
                status: 'preparing',
                date: 'اليوم، 07:15',
                timeline: []
            },
            {
                trackingNumber: 'TRK-2025-005',
                orderId: '12843',
                customer: 'خالد بنعلي',
                phone: '+212 6XX-XXXXXX',
                city: 'طنجة',
                address: 'شارع الجيش الملكي، طنجة',
                company: 'CTM',
                status: 'delayed',
                date: 'أمس، 14:00',
                timeline: []
            }
        ];

        // Render shipments table
        function renderShipments(shipments = shipmentsData) {
            const tbody = document.getElementById('shipmentsTableBody');
            tbody.innerHTML = '';

            shipments.forEach(shipment => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <span class="tracking-number" onclick="viewTracking('${shipment.trackingNumber}')">
                            ${shipment.trackingNumber}
                        </span>
                    </td>
                    <td><strong>#${shipment.orderId}</strong></td>
                    <td>
                        <div style="font-weight: 700;">${shipment.customer}</div>
                        <div style="font-size: 12px; color: var(--text-gray);">${shipment.phone}</div>
                    </td>
                    <td>${shipment.city}</td>
                    <td>${shipment.company}</td>
                    <td><span class="status-badge ${shipment.status}">${getStatusText(shipment.status)}</span></td>
                    <td>${shipment.date}</td>
                    <td>
                        <div class="actions-btns">
                            <button class="action-icon-btn view" onclick="viewTracking('${shipment.trackingNumber}')" title="تتبع">
                                📍
                            </button>
                            <button class="action-icon-btn update" onclick="quickUpdateStatus('${shipment.trackingNumber}')" title="تحديث">
                                🔄
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function getStatusText(status) {
            const statusMap = {
                'preparing': 'قيد التحضير',
                'in-transit': 'في الطريق',
                'out-for-delivery': 'خارج للتوصيل',
                'delivered': 'تم التسليم',
                'delayed': 'متأخر'
            };
            return statusMap[status] || status;
        }

        // View tracking details
        function viewTracking(trackingNumber) {
            const shipment = shipmentsData.find(s => s.trackingNumber === trackingNumber);
            if (!shipment) return;

            document.getElementById('modalTrackingNumber').textContent = trackingNumber;
            document.getElementById('trackingNumberInput').value = trackingNumber;
            document.getElementById('modalOrderNumber').textContent = '#' + shipment.orderId;
            document.getElementById('modalCustomer').textContent = `${shipment.customer} - ${shipment.phone}`;
            document.getElementById('modalAddress').textContent = shipment.address;
            document.getElementById('shippingCompanySelect').value = shipment.company;
            document.getElementById('updateStatusSelect').value = shipment.status;

            // Render timeline
            const timeline = document.getElementById('trackingTimeline');
            timeline.innerHTML = '';
            
            if (shipment.timeline && shipment.timeline.length > 0) {
                shipment.timeline.forEach(item => {
                    const timelineItem = document.createElement('div');
                    timelineItem.className = `timeline-item ${item.status}`;
                    timelineItem.innerHTML = `
                        <div class="timeline-icon">${item.status === 'completed' ? '✓' : item.status === 'active' ? '🚚' : '⏱️'}</div>
                        <div class="timeline-content">
                            <div class="timeline-title">${item.title}</div>
                            <div class="timeline-desc">${item.desc}</div>
                            ${item.time ? `<div class="timeline-time">${item.time}</div>` : ''}
                        </div>
                    `;
                    timeline.appendChild(timelineItem);
                });
            } else {
                timeline.innerHTML = '<div style="text-align: center; color: var(--text-gray); padding: 20px;">لا توجد تحديثات متاحة حالياً</div>';
            }

            document.getElementById('trackingModal').classList.add('active');
        }

        function closeTrackingModal() {
            document.getElementById('trackingModal').classList.remove('active');
        }

        function quickUpdateStatus(trackingNumber) {
            viewTracking(trackingNumber);
        }

        function updateShipmentStatus() {
            const newTrackingNumber = document.getElementById('trackingNumberInput').value.trim();
            const status = document.getElementById('updateStatusSelect').value;
            const shippingCompany = document.getElementById('shippingCompanySelect').value;
            
            if (!newTrackingNumber) {
                alert('يرجى إدخال رقم التتبع');
                return;
            }
            
            let message = '✅ تم التحديث بنجاح!\n\n';
            message += `📍 رقم التتبع: ${newTrackingNumber}\n`;
            message += `🚚 شركة الشحن: ${shippingCompany}\n`;
            message += `📊 الحالة الجديدة: ${getStatusText(status)}`;
            
            alert(message);
            closeTrackingModal();
        }

        function printShipment() {
            alert('جاري الطباعة...');
        }

        function exportShipments() {
            alert('جاري تصدير التقرير...');
        }

        // Sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // Close modal when clicking outside
        document.getElementById('trackingModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeTrackingModal();
            }
        });

        // Initialize
        renderShipments();
