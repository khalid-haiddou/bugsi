// Get CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// Categories data from Laravel
let categoriesData = window.categoriesData || [];

// Available icons for categories
const availableIcons = ['💊', '🥗', '💄', '🫒', '🌿', '🍯', '🧴', '💆', '🧘', '🏃', '🥤', '🍵', '🧪', '💉', '🩺', '🌱', '🥬', '🥕', '🍎', '🍊', '🥛', '🫖', '🧉', '🧊'];

// Current editing category ID
let editingCategoryId = null;

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
        
        const imageUrl = category.image ? `/storage/${category.image}` : null;
        
        card.innerHTML = `
            <div class="category-image-container">
                ${imageUrl ? 
                    `<img src="${imageUrl}" alt="${category.name}" class="category-image">` :
                    `<div class="category-icon">${category.icon}</div>`
                }
            </div>
            <div class="category-info">
                <div class="category-name">${category.name}</div>
                <div class="category-description">${category.description || ''}</div>
                <div class="category-footer">
                    <div class="category-products">
                        <strong>${category.products_count}</strong> منتج
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
    const form = document.getElementById('categoryForm');
    
    renderIconSelector();
    
    if (categoryId) {
        editingCategoryId = categoryId;
        title.textContent = 'تعديل الفئة';
        
        // Load category data
        loadCategory(categoryId);
    } else {
        editingCategoryId = null;
        title.textContent = 'إضافة فئة جديدة';
        form.reset();
        document.getElementById('categoryId').value = '';
        document.getElementById('methodField').value = '';
        document.getElementById('imagePreview').classList.remove('active');
        document.getElementById('selectedIcon').value = '';
        document.querySelectorAll('.icon-option').forEach(el => el.classList.remove('selected'));
    }
    
    modal.classList.add('active');
}

function closeCategoryModal() {
    document.getElementById('categoryModal').classList.remove('active');
    editingCategoryId = null;
}

// Load category data for editing
async function loadCategory(categoryId) {
    try {
        const response = await fetch(`/admin/categories/${categoryId}`, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            const category = data.category;
            document.getElementById('categoryId').value = category.id;
            document.getElementById('categoryName').value = category.name;
            document.getElementById('categoryDescription').value = category.description || '';
            document.getElementById('selectedIcon').value = category.icon;
            
            // Select the icon
            const icons = document.querySelectorAll('.icon-option');
            icons.forEach(iconEl => {
                if (iconEl.textContent === category.icon) {
                    iconEl.classList.add('selected');
                }
            });
            
            // Show existing image if any
            if (category.image) {
                document.getElementById('imageDisplay').src = `/storage/${category.image}`;
                document.getElementById('imagePreview').classList.add('active');
            }
        }
    } catch (error) {
        console.error('Error loading category:', error);
        alert('حدث خطأ أثناء تحميل بيانات الفئة');
    }
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

// Edit category
function editCategory(categoryId) {
    openCategoryModal(categoryId);
}

// Delete category
async function deleteCategory(categoryId) {
    const category = categoriesData.find(c => c.id === categoryId);
    
    if (!confirm(`هل أنت متأكد من حذف فئة "${category.name}"؟${category.products_count > 0 ? `\n\nتحتوي هذه الفئة على ${category.products_count} منتج.` : ''}`)) {
        return;
    }
    
    try {
        const response = await fetch(`/admin/categories/${categoryId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            // Remove from local array
            categoriesData = categoriesData.filter(c => c.id !== categoryId);
            renderCategories();
            // Reload page to update stats
            location.reload();
        } else {
            alert('حدث خطأ أثناء حذف الفئة');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('حدث خطأ أثناء حذف الفئة');
    }
}

// Form submission
document.getElementById('categoryForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const categoryName = document.getElementById('categoryName').value;
    const selectedIcon = document.getElementById('selectedIcon').value;
    const submitBtn = document.getElementById('submitBtn');
    
    if (!selectedIcon) {
        alert('يرجى اختيار أيقونة للفئة');
        return;
    }
    
    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span>⏳</span> جاري الحفظ...';
    
    const formData = new FormData(this);
    
    // Determine URL and method
    const isEditing = editingCategoryId !== null;
    const url = isEditing 
        ? `/admin/categories/${editingCategoryId}` 
        : '/admin/categories';
    
    if (isEditing) {
        formData.append('_method', 'PUT');
    }
    
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            closeCategoryModal();
            // Reload page to update the list
            location.reload();
        } else {
            if (data.errors) {
                const errorMessages = Object.values(data.errors).flat().join('\n');
                alert(errorMessages);
            } else {
                alert('حدث خطأ أثناء حفظ الفئة');
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert('حدث خطأ أثناء حفظ الفئة');
    } finally {
        // Re-enable button
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<span>💾</span> حفظ الفئة';
    }
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