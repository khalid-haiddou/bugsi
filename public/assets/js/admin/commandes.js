        // Sample orders data
        const ordersData = [
            {
                id: 12847,
                customer: { name: 'محمد الكريم', phone: '+212 6XX-XXXXXX', avatar: 'MK' },
                products: 'MMS × 2',
                city: 'الدار البيضاء',
                total: 520,
                status: 'pending',
                date: 'اليوم، 14:30',
                address: 'شارع محمد الخامس، حي المعاريف، الدار البيضاء',
                items: [
                    { name: 'MMS - محلول معدني معجزة', qty: 2, price: 150 }
                ]
            },
            {
                id: 12846,
                customer: { name: 'فاطمة الزهراء', phone: '+212 6XX-XXXXXX', avatar: 'FZ' },
                products: 'CDS × 1',
                city: 'الرباط',
                total: 220,
                status: 'confirmed',
                date: 'اليوم، 12:15',
                address: 'شارع الحسن الثاني، أكدال، الرباط',
                items: [
                    { name: 'CDS - محلول الكلور المركز', qty: 1, price: 220 }
                ]
            },
            {
                id: 12845,
                customer: { name: 'عمر الحسني', phone: '+212 6XX-XXXXXX', avatar: 'OH' },
                products: 'MMS × 1, CDS × 1',
                city: 'مراكش',
                total: 370,
                status: 'shipping',
                date: 'أمس، 18:45',
                address: 'شارع محمد السادس، جليز، مراكش',
                items: [
                    { name: 'MMS - محلول معدني معجزة', qty: 1, price: 150 },
                    { name: 'CDS - محلول الكلور المركز', qty: 1, price: 220 }
                ]
            },
            {
                id: 12844,
                customer: { name: 'سارة المنصوري', phone: '+212 6XX-XXXXXX', avatar: 'SM' },
                products: 'MMS × 3',
                city: 'فاس',
                total: 450,
                status: 'delivered',
                date: 'أمس، 16:20',
                address: 'شارع الحسن الثاني، المدينة الجديدة، فاس',
                items: [
                    { name: 'MMS - محلول معدني معجزة', qty: 3, price: 150 }
                ]
            },
            {
                id: 12843,
                customer: { name: 'خالد بنعلي', phone: '+212 6XX-XXXXXX', avatar: 'KB' },
                products: 'CDS × 2',
                city: 'طنجة',
                total: 440,
                status: 'cancelled',
                date: 'أمس، 10:05',
                address: 'شارع الجيش الملكي، طنجة',
                items: [
                    { name: 'CDS - محلول الكلور المركز', qty: 2, price: 220 }
                ]
            }
        ];

        // Render orders table
        function renderOrders(orders = ordersData) {
            const tbody = document.getElementById('ordersTableBody');
            tbody.innerHTML = '';

            orders.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="checkbox" class="checkbox"></td>
                    <td><a href="#" class="order-id" onclick="viewOrder(${order.id}); return false;">#${order.id}</a></td>
                    <td>
                        <div class="customer-info">
                            <div class="customer-avatar">${order.customer.avatar}</div>
                            <div class="customer-details">
                                <div class="customer-name">${order.customer.name}</div>
                                <div class="customer-phone">${order.customer.phone}</div>
                            </div>
                        </div>
                    </td>
                    <td>${order.products}</td>
                    <td>${order.city}</td>
                    <td><strong>${order.total} dhs</strong></td>
                    <td><span class="status-badge ${order.status}">${getStatusText(order.status)}</span></td>
                    <td>${order.date}</td>
                    <td>
                        <div class="actions-btns">
                            <button class="action-icon-btn view" onclick="viewOrder(${order.id})" title="عرض">👁️</button>
                            <button class="action-icon-btn edit" onclick="editOrder(${order.id})" title="تعديل">✏️</button>
                            <button class="action-icon-btn delete" onclick="deleteOrder(${order.id})" title="حذف">🗑️</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function getStatusText(status) {
            const statusMap = {
                'pending': 'قيد الانتظار',
                'confirmed': 'مؤكد',
                'shipping': 'قيد الشحن',
                'delivered': 'تم التسليم',
                'cancelled': 'ملغي'
            };
            return statusMap[status] || status;
        }

        // View order details
        function viewOrder(orderId) {
            const order = ordersData.find(o => o.id === orderId);
            if (!order) return;

            document.getElementById('modalOrderId').textContent = order.id;
            document.getElementById('modalCustomerAvatar').textContent = order.customer.avatar;
            document.getElementById('modalCustomerName').textContent = order.customer.name;
            document.getElementById('modalCustomerPhone').textContent = order.customer.phone;
            document.getElementById('modalAddress').textContent = order.address;
            
            // Render products
            const productsContainer = document.getElementById('modalProducts');
            productsContainer.innerHTML = '';
            order.items.forEach(item => {
                const productDiv = document.createElement('div');
                productDiv.className = 'product-item';
                productDiv.innerHTML = `
                    <div class="product-image"></div>
                    <div class="product-info">
                        <div class="product-name">${item.name}</div>
                        <div class="product-qty">الكمية: ${item.qty}</div>
                    </div>
                    <div class="product-price">${item.price * item.qty} dhs</div>
                `;
                productsContainer.appendChild(productDiv);
            });

            const subtotal = order.total >= 200 ? order.total : order.total - 40;
            const shipping = order.total >= 200 ? 0 : 40;
            
            document.getElementById('modalSubtotal').textContent = subtotal + ' dhs';
            document.getElementById('modalShipping').textContent = shipping === 0 ? 'مجاناً' : shipping + ' dhs';
            document.getElementById('modalShipping').style.color = shipping === 0 ? 'var(--success)' : 'var(--text-dark)';
            document.getElementById('modalTotal').textContent = order.total + ' dhs';
            
            document.getElementById('modalStatusSelect').value = order.status;

            document.getElementById('orderModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('orderModal').classList.remove('active');
        }

        function editOrder(orderId) {
            alert('تعديل الطلب #' + orderId);
        }

        function deleteOrder(orderId) {
            if (confirm('هل أنت متأكد من حذف الطلب #' + orderId + '؟')) {
                alert('تم حذف الطلب بنجاح');
            }
        }

        function updateOrderStatus() {
            alert('تم تحديث حالة الطلب بنجاح');
            closeModal();
        }

        function printOrder() {
            alert('جاري الطباعة...');
        }

        function filterByStatus(status) {
            // Remove active class from all stat cards
            document.querySelectorAll('.stat-card').forEach(card => {
                card.classList.remove('active');
            });
            
            // Add active class to clicked card
            event.currentTarget.classList.add('active');
            
            // Filter orders (in real app, this would filter the data)
            if (status === 'all') {
                renderOrders(ordersData);
            } else {
                const filtered = ordersData.filter(order => order.status === status);
                renderOrders(filtered);
            }
        }

        function createOrder() {
            alert('إنشاء طلب جديد');
        }

        function exportOrders() {
            alert('جاري تصدير البيانات...');
        }

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
        document.getElementById('orderModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });

        // Select all checkboxes
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('tbody .checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Initialize
        renderOrders();
