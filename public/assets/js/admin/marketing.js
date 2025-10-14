        // Sample campaigns data
        const campaignsData = [
            {
                id: 1,
                name: 'عرض نهاية الموسم - خصم 30%',
                status: 'sent',
                recipients: 1842,
                sent: '2024-12-15',
                openRate: 48.5,
                clickRate: 22.3
            },
            {
                id: 2,
                name: 'نشرة إخبارية - منتجات جديدة',
                status: 'sent',
                recipients: 1820,
                sent: '2024-12-10',
                openRate: 42.1,
                clickRate: 18.7
            },
            {
                id: 3,
                name: 'رسالة ترحيبية للمشتركين الجدد',
                status: 'scheduled',
                recipients: 127,
                sent: '2024-12-20 10:00',
                openRate: 0,
                clickRate: 0
            },
            {
                id: 4,
                name: 'تذكير بالسلة المتروكة',
                status: 'draft',
                recipients: 0,
                sent: null,
                openRate: 0,
                clickRate: 0
            }
        ];

        // Render campaigns
        function renderCampaigns(campaigns = campaignsData) {
            const list = document.getElementById('campaignsList');
            list.innerHTML = '';

            campaigns.forEach(campaign => {
                const item = document.createElement('div');
                item.className = 'campaign-item';
                item.onclick = () => viewCampaign(campaign.id);
                
                let statusText = campaign.status === 'sent' ? 'تم الإرسال' : 
                                campaign.status === 'scheduled' ? 'مجدولة' : 'مسودة';
                
                item.innerHTML = `
                    <div class="campaign-header">
                        <div class="campaign-name">${campaign.name}</div>
                        <div class="campaign-status ${campaign.status}">${statusText}</div>
                    </div>
                    <div class="campaign-meta">
                        <span>📧 ${campaign.recipients} مستلم</span>
                        <span>📅 ${campaign.sent || 'غير محدد'}</span>
                    </div>
                    ${campaign.status === 'sent' ? `
                        <div class="campaign-stats">
                            <div class="campaign-stat">
                                📊 معدل الفتح: <strong>${campaign.openRate}%</strong>
                            </div>
                            <div class="campaign-stat">
                                🖱️ معدل النقر: <strong>${campaign.clickRate}%</strong>
                            </div>
                        </div>
                    ` : ''}
                `;
                list.appendChild(item);
            });
        }

        // Modal functions
        function openCampaignModal(campaignId = null) {
            const modal = document.getElementById('campaignModal');
            const title = document.getElementById('modalTitle');
            
            if (campaignId) {
                title.textContent = 'تعديل الحملة';
            } else {
                title.textContent = 'إنشاء حملة بريدية جديدة';
                document.getElementById('campaignForm').reset();
            }
            
            modal.classList.add('active');
        }

        function closeCampaignModal() {
            document.getElementById('campaignModal').classList.remove('active');
        }

        // Campaign functions
        function viewCampaign(campaignId) {
            alert('عرض تفاصيل الحملة #' + campaignId);
        }

        function useTemplate(templateType) {
            openCampaignModal();
            document.getElementById('campaignTemplate').value = templateType;
            
            // Pre-fill based on template
            const templates = {
                'welcome': {
                    name: 'رسالة ترحيبية للمشتركين الجدد',
                    type: 'welcome',
                    subject: 'مرحباً بك في Bugsi! 🎉',
                    content: 'نحن سعداء بانضمامك إلى عائلة Bugsi...'
                },
                'offer': {
                    name: 'عرض خاص',
                    type: 'promotional',
                    subject: 'عرض حصري لك! خصم 30% 🎁',
                    content: 'احصل على خصم 30% على جميع المنتجات...'
                }
            };
            
            if (templates[templateType]) {
                document.getElementById('campaignName').value = templates[templateType].name;
                document.getElementById('campaignType').value = templates[templateType].type;
                document.getElementById('campaignSubject').value = templates[templateType].subject;
                document.getElementById('campaignContent').value = templates[templateType].content;
            }
        }

        function viewAllCampaigns() {
            alert('عرض جميع الحملات');
        }

        function viewSubscribers() {
            alert('عرض قائمة المشتركين');
        }

        function exportSubscribers() {
            alert('جاري تصدير قائمة المشتركين...');
        }

        // Form submission
        document.getElementById('campaignForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('campaignName').value;
            const status = document.getElementById('campaignStatus').value;
            
            let message = '✅ تم إنشاء الحملة بنجاح!\n\n';
            message += `📧 اسم الحملة: ${name}\n`;
            
            if (status === 'send-now') {
                message += '🚀 سيتم إرسال الحملة الآن';
            } else if (status === 'scheduled') {
                message += '⏰ تم جدولة الحملة';
            } else {
                message += '📝 تم حفظ الحملة كمسودة';
            }
            
            alert(message);
            closeCampaignModal();
        });

        // Show/hide schedule date based on status
        document.getElementById('campaignStatus').addEventListener('change', function() {
            const scheduleGroup = document.getElementById('scheduleGroup');
            if (this.value === 'scheduled') {
                scheduleGroup.style.display = 'block';
            } else {
                scheduleGroup.style.display = 'none';
            }
        });

        // Update estimated recipients based on audience
        document.getElementById('campaignAudience').addEventListener('change', function() {
            const recipients = {
                'all': 1842,
                'customers': 1215,
                'subscribers': 627,
                'inactive': 315
            };
            
            document.getElementById('estimatedRecipients').textContent = recipients[this.value] || 0;
        });

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
        document.getElementById('campaignModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeCampaignModal();
            }
        });

        // Initialize
        renderCampaigns();
