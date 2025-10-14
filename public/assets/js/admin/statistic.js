        // Sample sales data for the week
        const salesData = [
            { day: 'السبت', sales: 3200 },
            { day: 'الأحد', sales: 4800 },
            { day: 'الإثنين', sales: 4100 },
            { day: 'الثلاثاء', sales: 6200 },
            { day: 'الأربعاء', sales: 5400 },
            { day: 'الخميس', sales: 7100 },
            { day: 'الجمعة', sales: 8500 }
        ];

        // Render sales chart
        function renderSalesChart(data = salesData) {
            const chartContainer = document.getElementById('salesChart');
            const labelsContainer = document.getElementById('chartLabels');
            
            chartContainer.innerHTML = '';
            labelsContainer.innerHTML = '';

            const maxSales = Math.max(...data.map(d => d.sales));

            data.forEach(item => {
                const bar = document.createElement('div');
                bar.className = 'chart-bar';
                const height = (item.sales / maxSales) * 100;
                bar.style.height = height + '%';
                bar.innerHTML = `<span class="chart-value">${item.sales.toLocaleString()} dhs</span>`;
                chartContainer.appendChild(bar);

                const label = document.createElement('span');
                label.className = 'chart-label';
                label.textContent = item.day;
                labelsContainer.appendChild(label);
            });
        }

        // Change period
        function changePeriod(period) {
            // Remove active class from all buttons
            document.querySelectorAll('.period-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Add active class to clicked button
            event.currentTarget.classList.add('active');
            
            // Update data based on period (in real app, fetch from server)
            alert('تم تغيير الفترة إلى: ' + period);
        }

        // Export report
        function exportReport() {
            alert('جاري تصدير التقرير الكامل...');
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

        // Initialize
        renderSalesChart();
