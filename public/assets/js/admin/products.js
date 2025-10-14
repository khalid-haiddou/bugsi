const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
let productsData = window.productsData || [];
let categoriesData = window.categoriesData || [];
let editingProductId = null;
let galleryImages = [];

function renderProductsGrid(products = productsData) {
    const grid = document.getElementById('productsGrid');
    grid.innerHTML = '';

    if (products.length === 0) {
        grid.innerHTML = `
            <div class="empty-state" style="grid-column: 1 / -1;">
                <div class="empty-icon">📦</div>
                <div class="empty-title">لا توجد منتجات</div>
                <div class="empty-text">ابدأ بإضافة منتج جديد إلى المتجر</div>
                <button class="btn btn-primary" onclick="openProductModal()">
                    <span>➕</span>
                    إضافة منتج جديد
                </button>
            </div>
        `;
        return;
    }

    products.forEach(product => {
        const stockBadge = getStockBadge(product.stock);
        const priceDisplay = getPriceDisplay(product);
        const discountBadge = product.has_discount ? `<div class="discount-badge">-${product.discount_percentage}%</div>` : '';
        
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
            <div class="product-image-container">
                <img src="${product.main_image_url || 'https://via.placeholder.com/300x300/0e9eff/ffffff?text=صورة'}" alt="${product.name}" class="product-image">
                ${stockBadge}
                ${discountBadge}
            </div>
            <div class="product-info">
                <div class="product-category">${product.category?.name || product.category}</div>
                <div class="product-code">${product.product_code || ''}</div>
                <div class="product-name">${product.name}</div>
                <div class="product-description">${product.short_description || product.description || ''}</div>
                <div class="product-footer">
                    <div>
                        ${priceDisplay}
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

function renderProductsTable(products = productsData) {
    const tbody = document.getElementById('productsTableBody');
    tbody.innerHTML = '';

    products.forEach(product => {
        const priceDisplay = getPriceDisplay(product);
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <div class="table-product-info">
                    <img src="${product.main_image_url || 'https://via.placeholder.com/60x60/0e9eff/ffffff?text=صورة'}" alt="${product.name}" class="table-product-image">
                    <div class="table-product-details">
                        <div class="table-product-name">${product.name}</div>
                        <div class="table-product-category">${product.category?.name || product.category}</div>
                    </div>
                </div>
            </td>
            <td><code>${product.product_code || '-'}</code></td>
            <td>${product.category?.name || product.category}</td>
            <td>${priceDisplay}</td>
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

function getPriceDisplay(product) {
    if (product.has_discount && product.sales_price) {
        return `
            <div class="price-container">
                <div class="product-price-old">${product.price} MAD</div>
                <div class="product-price-sale">${product.sales_price} MAD</div>
            </div>
        `;
    } else {
        return `<div class="product-price">${product.final_price || product.price} MAD</div>`;
    }
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

async function applyFilters() {
    const category = document.getElementById('categoryFilter').value;
    const status = document.getElementById('statusFilter').value;
    const stock = document.getElementById('stockFilter').value;
    const sort = document.getElementById('sortFilter').value;
    
    try {
        const params = new URLSearchParams();
        if (category) params.append('category', category);
        if (status) params.append('status', status);
        if (stock) params.append('stock', stock);
        if (sort) params.append('sort', sort);
        
        const response = await fetch(`/admin/products/api?${params.toString()}`, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            productsData = data.products;
            renderProductsGrid();
            renderProductsTable();
        }
    } catch (error) {
        console.error('Error applying filters:', error);
    }
}

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

function openProductModal(productId = null) {
    const modal = document.getElementById('productModal');
    const title = document.getElementById('modalTitle');
    const form = document.getElementById('productForm');
    
    galleryImages = [];
    document.getElementById('galleryGrid').innerHTML = '';
    document.getElementById('galleryCount').innerHTML = '';
    
    if (productId) {
        editingProductId = productId;
        title.textContent = 'تعديل المنتج';
        loadProduct(productId);
    } else {
        editingProductId = null;
        title.textContent = 'إضافة منتج جديد';
        form.reset();
        document.getElementById('productId').value = '';
        document.getElementById('methodField').value = '';
        document.getElementById('mainImagePreview').classList.remove('active');
        
        // Clear additional info fields
        document.getElementById('productSize').value = '';
        document.getElementById('productUsage').value = '';
        document.getElementById('productExpiry').value = '';
        document.getElementById('productIngredients').value = '';
        document.getElementById('productStorage').value = '';
    }
    
    modal.classList.add('active');
}

function closeProductModal() {
    document.getElementById('productModal').classList.remove('active');
    editingProductId = null;
    galleryImages = [];
}

async function loadProduct(productId) {
    try {
        const response = await fetch(`/admin/products/${productId}`, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            const product = data.product;
            document.getElementById('productId').value = product.id;
            document.getElementById('productName').value = product.name;
            document.getElementById('productCode').value = product.product_code || '';
            document.getElementById('productDescription').value = product.description || '';
            document.getElementById('productShortDescription').value = product.short_description || '';
            document.getElementById('productTags').value = product.tags || '';
            document.getElementById('productPrice').value = product.price;
            document.getElementById('productSalesPrice').value = product.sales_price || '';
            document.getElementById('productStock').value = product.stock;
            document.getElementById('productStatus').value = product.status;
            document.getElementById('productCategory').value = product.category_id;
            
            // Load additional info
            if (product.additional_info) {
                document.getElementById('productSize').value = product.additional_info.size || '';
                document.getElementById('productUsage').value = product.additional_info.usage || '';
                document.getElementById('productExpiry').value = product.additional_info.expiry || '';
                document.getElementById('productIngredients').value = product.additional_info.ingredients || '';
                document.getElementById('productStorage').value = product.additional_info.storage || '';
            } else {
                // Clear fields if no additional info
                document.getElementById('productSize').value = '';
                document.getElementById('productUsage').value = '';
                document.getElementById('productExpiry').value = '';
                document.getElementById('productIngredients').value = '';
                document.getElementById('productStorage').value = '';
            }
            
            if (product.main_image_url) {
                document.getElementById('mainImageDisplay').src = product.main_image_url;
                document.getElementById('mainImagePreview').classList.add('active');
            }
            
            if (product.gallery_image_urls && product.gallery_image_urls.length > 0) {
                galleryImages = product.gallery_image_urls;
                renderGallery();
            }
        }
    } catch (error) {
        console.error('Error loading product:', error);
        alert('حدث خطأ أثناء تحميل بيانات المنتج');
    }
}

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

function removeMainImage() {
    document.getElementById('productMainImage').value = '';
    document.getElementById('mainImagePreview').classList.remove('active');
}

function previewGalleryImages(event) {
    const files = Array.from(event.target.files);
    galleryImages = [];
    
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

function removeGalleryImage(index) {
    galleryImages.splice(index, 1);
    renderGallery();
}

function viewProduct(productId) {
    alert('عرض تفاصيل المنتج #' + productId);
}

function editProduct(productId) {
    openProductModal(productId);
}

async function deleteProduct(productId) {
    const product = productsData.find(p => p.id === productId);
    
    if (!confirm(`هل أنت متأكد من حذف المنتج "${product.name}"؟`)) {
        return;
    }
    
    try {
        const response = await fetch(`/admin/products/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            productsData = productsData.filter(p => p.id !== productId);
            renderProductsGrid();
            renderProductsTable();
            location.reload();
        } else {
            alert('حدث خطأ أثناء حذف المنتج');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('حدث خطأ أثناء حذف المنتج');
    }
}

function importProducts() {
    alert('استيراد المنتجات من ملف Excel');
}

document.getElementById('productForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const productName = document.getElementById('productName').value;
    const productCode = document.getElementById('productCode').value;
    const price = parseFloat(document.getElementById('productPrice').value);
    const salesPrice = parseFloat(document.getElementById('productSalesPrice').value);
    const mainImageFile = document.getElementById('productMainImage').files[0];
    const galleryFiles = document.getElementById('productGallery').files;
    const submitBtn = document.getElementById('submitBtn');
    
    // Validation
    if (!productCode.trim()) {
        alert('يرجى إدخال رمز المنتج');
        return;
    }
    
    if (salesPrice && salesPrice >= price) {
        alert('سعر التخفيض يجب أن يكون أقل من السعر الأساسي');
        return;
    }
    
    if (!editingProductId && !mainImageFile) {
        alert('يرجى رفع الصورة الرئيسية للمنتج');
        return;
    }
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span>⏳</span> جاري الحفظ...';
    
    const formData = new FormData(this);
    
    if (galleryFiles.length > 0) {
        for (let i = 0; i < galleryFiles.length; i++) {
            formData.append('gallery_images[]', galleryFiles[i]);
        }
    }
    
    const isEditing = editingProductId !== null;
    const url = isEditing 
        ? `/admin/products/${editingProductId}` 
        : '/admin/products';
    
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
            closeProductModal();
            location.reload();
        } else {
            if (data.errors) {
                const errorMessages = Object.values(data.errors).flat().join('\n');
                alert(errorMessages);
            } else {
                alert('حدث خطأ أثناء حفظ المنتج');
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert('حدث خطأ أثناء حفظ المنتج');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<span>💾</span> حفظ المنتج';
    }
});

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('active');
}

document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.querySelector('.menu-toggle');
    
    if (window.innerWidth <= 768) {
        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    }
});

document.getElementById('productModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeProductModal();
    }
});

renderProductsGrid();
renderProductsTable();