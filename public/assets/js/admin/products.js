        // Sample products data
        const productsData = [
            {
                id: 1,
                name: 'MMS - محلول معدني معجزة',
                category: 'الصحة والعافية',
                categorySlug: 'health',
                price: 150,
                stock: 85,
                status: 'active',
                description: 'محلول معدني معجزة للصحة العامة',
                image: 'https://via.placeholder.com/300x300/0e9eff/ffffff?text=MMS'
            },
            {
                id: 2,
                name: 'CDS - محلول الكلور المركز',
                category: 'الصحة والعافية',
                categorySlug: 'health',
                price: 220,
                stock: 45,
                status: 'active',
                description: 'محلول كلور مركز عالي الجودة',
                image: 'https://via.placeholder.com/300x300/00d2d3/ffffff?text=CDS'
            },
            {
                id: 3,
                name: 'فيتامين سي المركز',
                category: 'المكملات الغذائية',
                categorySlug: 'supplements',
                price: 180,
                stock: 5,
                status: 'active',
                description: 'فيتامين سي عالي التركيز',
                image: 'https://via.placeholder.com/300x300/ff9800/ffffff?text=Vit+C'
            },
            {
                id: 4,
                name: 'زيت الأرغان المغربي',
                category: 'العناية والجمال',
                categorySlug: 'beauty',
                price: 120,
                stock: 0,
                status: 'active',
                description: 'زيت أرغان طبيعي 100%',
                image: 'https://via.placeholder.com/300x300/8bc34a/ffffff?text=Argan'
            },
            {
                id: 5,
                name: 'مكمل الأوميغا 3',
                category: 'المكملات الغذائية',
                categorySlug: 'supplements',
                price: 200,
                stock: 120,
                status: 'active',
                description: 'مكمل غذائي غني بالأوميغا 3',
                image: 'https://via.placeholder.com/300x300/2196f3/ffffff?text=Omega+3'
            },
            {
                id: 6,
                name: 'كريم الكولاجين',
                category: 'العناية والجمال',
                categorySlug: 'beauty',
                price: 250,
                stock: 65,
                status: 'inactive',
                description: 'كريم كولاجين لنضارة البشرة',
                image: 'https://via.placeholder.com/300x300/e91e63/ffffff?text=Collagen'
            }
        ];

        // Render products in grid view
        function renderProductsGrid(products = productsData) {
            const grid = document.getElementById('productsGrid');
            grid.innerHTML = '';

            products.forEach(product => {
                const stockBadge = getStockBadge(product.stock);
                const card = document.createElement('div');
                card.className = 'product-card';
                card.innerHTML = `
                    <div class="product-image-container">
                        <img src="${product.image}" alt="${product.name}" class="product-image">
                        ${stockBadge}
                    </div>
                    <div class="product-info">
                        <div class="product-category">${product.category}</div>
                        <div class="product-name">${product.name}</div>
                        <div class="product-description">${product.description}</div>
                        <div class="product-footer">
                            <div>
                                <div class="product-price">${product.price} dhs</div>
                                <div class="product-stock">المخزون: ${product.stock}</div>
                            </div>
                        </div>
                        <div class="product-actions">
                            <button class="product-action-btn edit" onclick="editProduct(${product.id})">
                                ✏️ تعديل
                            </button>
                            <button class="product-action-btn delete" onclick="deleteProduct(${product.id})">
                                🗑️ حذف
                            </button>
                        </div>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        // Render products in table view
        function renderProductsTable(products = productsData) {
            const tbody = document.getElementById('productsTableBody');
            tbody.innerHTML = '';

            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <div class="table-product-info">
                            <img src="${product.image}" alt="${product.name}" class="table-product-image">
                            <div class="table-product-details">
                                <div class="table-product-name">${product.name}</div>
                                <div class="table-product-category">${product.category}</div>
                            </div>
                        </div>
                    </td>
                    <td>${product.category}</td>
                    <td><strong>${product.price} dhs</strong></td>
                    <td>${getStockText(product.stock)}</td>
                    <td>
                        <span class="status-badge ${product.status}">
                            ${product.status === 'active' ? 'نشط' : 'غير نشط'}
                        </span>
                    </td>
                    <td>
                        <div class="actions-btns">
                            <button class="action-icon-btn view" onclick="viewProduct(${product.id})" title="عرض">👁️</button>
                            <button class="action-icon-btn edit" onclick="editProduct(${product.id})" title="تعديل">✏️</button>
                            <button class="action-icon-btn delete" onclick="deleteProduct(${product.id})" title="حذف">🗑️</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function getStockBadge(stock) {
            if (stock === 0) {
                return '<div class="product-badge out-of-stock">نفذ من المخزون</div>';
            } else if (stock < 10) {
                return '<div class="product-badge low-stock">مخزون منخفض</div>';
            } else {
                return '<div class="product-badge">متوفر</div>';
            }
        }

        function getStockText(stock) {
            if (stock === 0) {
                return '<span style="color: var(--danger); font-weight: 700;">نفذ (0)</span>';
            } else if (stock < 10) {
                return `<span style="color: var(--warning); font-weight: 700;">منخفض (${stock})</span>`;
            } else {
                return `<span style="color: var(--success); font-weight: 700;">متوفر (${stock})</span>`;
            }
        }

        // Toggle view
        function toggleView(view) {
            const gridView = document.getElementById('productsGrid');
            const tableView = document.getElementById('productsTable');
            const viewBtns = document.querySelectorAll('.view-btn');

            viewBtns.forEach(btn => btn.classList.remove('active'));
            event.currentTarget.classList.add('active');

            if (view === 'grid') {
                gridView.style.display = 'grid';
                tableView.classList.remove('active');
            } else {
                gridView.style.display = 'none';
                tableView.classList.add('active');
            }
        }

        // Modal functions
        let galleryImages = [];

        function openProductModal(productId = null) {
            const modal = document.getElementById('productModal');
            const title = document.getElementById('modalTitle');
            
            // Reset gallery
            galleryImages = [];
            document.getElementById('galleryGrid').innerHTML = '';
            document.getElementById('galleryCount').innerHTML = '';
            
            if (productId) {
                title.textContent = 'تعديل المنتج';
                // Load product data here
            } else {
                title.textContent = 'إضافة منتج جديد';
                document.getElementById('productForm').reset();
                document.getElementById('mainImagePreview').classList.remove('active');
            }
            
            modal.classList.add('active');
        }

        function closeProductModal() {
            document.getElementById('productModal').classList.remove('active');
            galleryImages = [];
        }

        // Preview main image
        function previewMainImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('mainImageDisplay').src = e.target.result;
                    document.getElementById('mainImagePreview').classList.add('active');
                };
                reader.readAsDataURL(file);
            }
        }

        // Remove main image
        function removeMainImage() {
            document.getElementById('productMainImage').value = '';
            document.getElementById('mainImagePreview').classList.remove('active');
        }

        // Preview gallery images
        function previewGalleryImages(event) {
            const files = Array.from(event.target.files);
            
            files.forEach(file => {
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        galleryImages.push(e.target.result);
                        renderGallery();
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Render gallery
        function renderGallery() {
            const grid = document.getElementById('galleryGrid');
            const countDiv = document.getElementById('galleryCount');
            
            grid.innerHTML = '';
            
            galleryImages.forEach((image, index) => {
                const item = document.createElement('div');
                item.className = 'gallery-item';
                item.innerHTML = `
                    <img src="${image}" class="gallery-image" alt="صورة ${index + 1}">
                    <button type="button" class="remove-gallery-btn" onclick="removeGalleryImage(${index})">×</button>
                `;
                grid.appendChild(item);
            });

            if (galleryImages.length > 0) {
                countDiv.innerHTML = `<span class="image-count-badge">عدد الصور: ${galleryImages.length}</span>`;
            } else {
                countDiv.innerHTML = '';
            }
        }

        // Remove gallery image
        function removeGalleryImage(index) {
            galleryImages.splice(index, 1);
            renderGallery();
        }

        // CRUD operations
        function viewProduct(productId) {
            alert('عرض تفاصيل المنتج #' + productId);
        }

        function editProduct(productId) {
            openProductModal(productId);
        }

        function deleteProduct(productId) {
            if (confirm('هل أنت متأكد من حذف هذا المنتج؟')) {
                alert('تم حذف المنتج بنجاح');
                // Remove from array and re-render
            }
        }

        function importProducts() {
            alert('استيراد المنتجات من ملف Excel');
        }

        // Form submission
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const productName = document.getElementById('productName').value;
            const mainImage = document.getElementById('productMainImage').files[0];
            
            if (!mainImage) {
                alert('يرجى رفع الصورة الرئيسية للمنتج');
                return;
            }
            
            let message = `تم حفظ المنتج "${productName}" بنجاح!\n`;
            message += `✓ الصورة الرئيسية: تم الرفع\n`;
            
            if (galleryImages.length > 0) {
                message += `✓ معرض الصور: ${galleryImages.length} صورة`;
            }
            
            alert(message);
            closeProductModal();
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
        document.getElementById('productModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeProductModal();
            }
        });

        // Initialize
        renderProductsGrid();
        renderProductsTable();
