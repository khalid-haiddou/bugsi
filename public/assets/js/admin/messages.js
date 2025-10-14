        // Sample messages data
        const messagesData = [
            {
                id: 1,
                name: 'محمد الكريم',
                email: 'mohamed@example.com',
                subject: 'استفسار عن منتج MMS',
                message: 'مرحباً، أود الاستفسار عن منتج MMS وكيفية استخدامه. هل يمكنكم تزويدي بمعلومات أكثر عن الفوائد والجرعة المناسبة؟',
                status: 'new',
                date: 'اليوم، 14:30',
                isUnread: true
            },
            {
                id: 2,
                name: 'فاطمة الزهراء',
                email: 'fatima@example.com',
                subject: 'سؤال عن الشحن',
                message: 'هل يمكن الشحن إلى مدينة أكادير؟ وما هي تكلفة الشحن؟',
                status: 'new',
                date: 'اليوم، 12:15',
                isUnread: true
            },
            {
                id: 3,
                name: 'عمر الحسني',
                email: 'omar@example.com',
                subject: 'طلب معلومات عن الأسعار',
                message: 'السلام عليكم، أريد معرفة الأسعار بالتفصيل وهل توجد عروض خاصة للكميات الكبيرة؟',
                status: 'read',
                date: 'أمس، 18:45',
                isUnread: false
            },
            {
                id: 4,
                name: 'سارة المنصوري',
                email: 'sara@example.com',
                subject: 'شكر وتقدير',
                message: 'شكراً جزيلاً على الخدمة الممتازة والتوصيل السريع. أنا راضية جداً عن المنتج.',
                status: 'replied',
                date: 'أمس، 16:20',
                isUnread: false
            },
            {
                id: 5,
                name: 'خالد بنعلي',
                email: 'khaled@example.com',
                subject: 'مشكلة في الطلب',
                message: 'لدي مشكلة في طلبي رقم #12843. لم يصلني المنتج حتى الآن رغم مرور أسبوع.',
                status: 'replied',
                date: 'منذ يومين، 10:05',
                isUnread: false
            },
            {
                id: 6,
                name: 'نادية العلوي',
                email: 'nadia@example.com',
                subject: 'استفسار عن التركيبة',
                message: 'هل المنتجات خالية من المواد الكيميائية الضارة؟ أبحث عن منتجات طبيعية 100%.',
                status: 'read',
                date: 'منذ 3 أيام',
                isUnread: false
            },
            {
                id: 7,
                name: 'يوسف القاسمي',
                email: 'youssef@example.com',
                subject: 'طلب عينة مجانية',
                message: 'هل يمكنني الحصول على عينة مجانية قبل الشراء لتجربة المنتج؟',
                status: 'new',
                date: 'اليوم، 09:20',
                isUnread: true
            },
            {
                id: 8,
                name: 'ليلى الإدريسي',
                email: 'layla@example.com',
                subject: 'استفسار عن طريقة الدفع',
                message: 'هل تقبلون الدفع عن طريق البطاقة البنكية أم فقط الدفع عند الاستلام؟',
                status: 'read',
                date: 'أمس، 20:15',
                isUnread: false
            }
        ];

        // Render messages table
        function renderMessages(messages = messagesData) {
            const tbody = document.getElementById('messagesTableBody');
            tbody.innerHTML = '';

            messages.forEach(message => {
                const row = document.createElement('tr');
                if (message.isUnread) {
                    row.classList.add('unread');
                }
                
                row.innerHTML = `
                    <td><input type="checkbox" class="checkbox"></td>
                    <td>
                        <div class="sender-info">
                            <div class="sender-avatar">${message.name.charAt(0)}</div>
                            <div class="sender-details">
                                <div class="sender-name">${message.name}</div>
                                <div class="sender-email">${message.email}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="message-subject" onclick="viewMessage(${message.id})">${message.subject}</div>
                        <div class="message-preview">${message.message.substring(0, 60)}...</div>
                    </td>
                    <td><span class="status-badge ${message.status}">${getStatusText(message.status)}</span></td>
                    <td>${message.date}</td>
                    <td>
                        <div class="actions-btns">
                            <button class="action-icon-btn view" onclick="viewMessage(${message.id})" title="عرض">👁️</button>
                            <button class="action-icon-btn reply" onclick="replyToMessage(${message.id})" title="رد">↩️</button>
                            <button class="action-icon-btn delete" onclick="deleteMessage(${message.id})" title="حذف">🗑️</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function getStatusText(status) {
            const statusMap = {
                'new': 'جديدة',
                'read': 'مقروءة',
                'replied': 'تم الرد',
                'archived': 'مؤرشفة'
            };
            return statusMap[status] || status;
        }

        // View message details
        function viewMessage(messageId) {
            const message = messagesData.find(m => m.id === messageId);
            if (!message) return;

            document.getElementById('modalSenderName').textContent = message.name;
            document.getElementById('modalSenderEmail').textContent = message.email;
            document.getElementById('modalSubject').textContent = message.subject;
            document.getElementById('modalDate').textContent = message.date;
            document.getElementById('modalMessageText').textContent = message.message;
            document.getElementById('messageStatusSelect').value = message.status;
            document.getElementById('replyText').value = '';

            document.getElementById('messageModal').classList.add('active');

            // Mark as read
            if (message.isUnread) {
                message.isUnread = false;
                message.status = 'read';
                renderMessages();
            }
        }

        function replyToMessage(messageId) {
            viewMessage(messageId);
            document.getElementById('replyText').focus();
        }

        function closeMessageModal() {
            document.getElementById('messageModal').classList.remove('active');
        }

        function sendReply() {
            const replyText = document.getElementById('replyText').value.trim();
            const newStatus = document.getElementById('messageStatusSelect').value;

            if (!replyText) {
                alert('يرجى كتابة الرد أولاً');
                return;
            }

            alert('✅ تم إرسال الرد بنجاح!\n\nسيتم إرسال رسالة بريد إلكتروني للعميل.');
            closeMessageModal();
        }

        function deleteMessage(messageId) {
            const message = messagesData.find(m => m.id === messageId);
            if (confirm(`هل أنت متأكد من حذف رسالة "${message.subject}"؟`)) {
                alert('تم حذف الرسالة بنجاح');
            }
        }

        function filterByStatus(status) {
            // Remove active class from all stat cards
            document.querySelectorAll('.stat-card').forEach(card => {
                card.classList.remove('active');
            });
            
            // Add active class to clicked card
            event.currentTarget.classList.add('active');
            
            // Filter messages
            if (status === 'all') {
                renderMessages(messagesData);
            } else {
                const filtered = messagesData.filter(message => message.status === status);
                renderMessages(filtered);
            }
        }

        function exportMessages() {
            alert('جاري تصدير الرسائل...');
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
        document.getElementById('messageModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeMessageModal();
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
        renderMessages();
