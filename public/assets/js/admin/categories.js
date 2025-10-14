        // Sample categories data
        const categoriesData = [
            {
                id: 1,
                name: 'الصحة والعافية',
                description: 'منتجات صحية طبيعية للعناية بالصحة العامة',
                icon: '💊',
                productsCount: 45,
                image: null
            },
            {
                id: 2,
                name: 'المكملات الغذائية',
                description: 'فيتامينات ومكملات غذائية عالية الجودة',
                icon: '🥗',
                productsCount: 38,
                image: null
            },
            {
                id: 3,
                name: 'العناية والجمال',
                description: 'منتجات العناية بالبشرة والجمال الطبيعي',
                icon: '💄',
                productsCount: 28,
                image: null
            },
            {
                id: 4,
                name: 'الزيوت الطبيعية',
                description: 'زيوت طبيعية نقية 100% من المغرب',
                icon: '🫒',
                productsCount: 22,
                image: null
            },
            {
                id: 5,
                name: 'الأعشاب الطبية',
                description: 'أعشاب طبيعية للعلاج والوقاية',
                icon: '🌿',
                productsCount: 15,
                image: null
            },
            {
                id: 6,
                name: 'العسل والمنتجات النحلية',
                description: 'عسل طبيعي ومنتجات نحلية عضوية',
                icon: '🍯',
                productsCount: 8,
                image: null
            }
        ];

        // Available icons for categories
        const availableIcons = ['💊', '🥗', '💄', '🫒', '🌿', '🍯', '🧴', '💆', '🧘', '🏃', '🥤', '🍵', '🧪', '💉', '🩺', '🌱', '🥬', '🥕', '🍎', '🍊', '🥛', '🫖', '🧉', '🧊'];

        // Render categories grid
        function renderCategories(categories = categoriesData) {
            const grid = document.getElementById('categoriesGrid');
            grid.innerHTML = '';

            if (categories.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <div class="empty-icon">📂</div>
                        <div class="empty-title">لا توجد فئات</div>
                        <div class="empty-text">ابدأ بإضافة فئة جديدة لتنظيم منتجاتك</div>
                        <button class="btn btn-primary" onclick="openCategoryModal()">
                            <span>➕</span>
                            إضافة فئة جديدة
                        </button>
                    </div>
                `;
                return;
            }

            categories.forEach(category => {
                const card = document.createElement('div');
                card.className = 'category-card';
                card.innerHTML = `
                    <div class="category-image-container">
                        ${category.image ? 
                            `<img src="${category.image}" alt="${category.name}" class="category-image">` :
                            `<div class="category-icon">${category.icon}</div>`
                        }
                    </div>
                    <div class="category-info">
                        <div class="category-name">${category.name}</div>
                        <div class="category-description">${category.description}</div>
                        <div class="category-footer">
                            <div class="category-products">
                                <strong>${category.productsCount}</strong> منتج
                            </div>
                            <div class="category-actions">
                                <button class="action-icon-btn edit" onclick="editCategory(${category.id})" title="تعديل">
                                    ✏️
                                </button>
                                <button class="action-icon-btn delete" onclick="deleteCategory(${category.id})" title="حذف">
                                    🗑️
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        // Render icon selector
        function renderIconSelector() {
            const selector = document.getElementById('iconSelector');
            selector.innerHTML = '';

            availableIcons.forEach(icon => {
                const iconDiv = document.createElement('div');
                iconDiv.className = 'icon-option';
                iconDiv.textContent = icon;
                iconDiv.onclick = function() {
                    document.querySelectorAll('.icon-option').forEach(el => el.classList.remove('selected'));
                    this.classList.add('selected');
                    document.getElementById('selectedIcon').value = icon;
                };
                selector.appendChild(iconDiv);
            });
        }

        // Modal functions
        function openCategoryModal(categoryId = null) {
            const modal = document.getElementById('categoryModal');
            const title = document.getElementById('modalTitle');
            
            renderIconSelector();
            
            if (categoryId) {
                title.textContent = 'تعديل الفئة';
                // Load category data here
                const category = categoriesData.find(c => c.id === categoryId);
                if (category) {
                    document.getElementById('categoryName').value = category.name;
                    document.getElementById('categoryDescription').value = category.description;
                    document.getElementById('selectedIcon').value = category.icon;
                    
                    // Select the icon
                    const icons = document.querySelectorAll('.icon-option');
                    icons.forEach(iconEl => {
                        if (iconEl.textContent === category.icon) {
                            iconEl.classList.add('selected');
                        }
                    });
                }
            } else {
                title.textContent = 'إضافة فئة جديدة';
                document.getElementById('categoryForm').reset();
                document.getElementById('imagePreview').classList.remove('active');
                document.getElementById('selectedIcon').value = '';
            }
            
            modal.classList.add('active');
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.remove('active');
        }

        // Preview category image
        function previewCategoryImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imageDisplay').src = e.target.result;
                    document.getElementById('imagePreview').classList.add('active');
                };
                reader.readAsDataURL(file);
            }
        }

        // Remove category image
        function removeCategoryImage() {
            document.getElementById('categoryImage').value = '';
            document.getElementById('imagePreview').classList.remove('active');
        }

        // CRUD operations
        function editCategory(categoryId) {
            openCategoryModal(categoryId);
        }

        function deleteCategory(categoryId) {
            const category = categoriesData.find(c => c.id === categoryId);
            if (confirm(`هل أنت متأكد من حذف فئة "${category.name}"؟\n\nتحتوي هذه الفئة على ${category.productsCount} منتج.`)) {
                alert('تم حذف الفئة بنجاح');
                // Remove from array and re-render
            }
        }

        // Form submission
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const categoryName = document.getElementById('categoryName').value;
            const selectedIcon = document.getElementById('selectedIcon').value;
            
            if (!selectedIcon) {
                alert('يرجى اختيار أيقونة للفئة');
                return;
            }
            
            alert(`تم حفظ الفئة "${categoryName}" بنجاح! ${selectedIcon}`);
            closeCategoryModal();
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
        document.getElementById('categoryModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeCategoryModal();
            }
        });

        // Initialize
        renderCategories();
