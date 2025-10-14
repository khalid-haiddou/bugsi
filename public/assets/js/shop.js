// Get CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// Shop data from server
let shopData = window.shopData || { products: [], currentPage: 1, lastPage: 1, total: 0 };
let isLoading = false;

// DOM elements
const productsGrid = document.getElementById('productsGrid');
const loadingState = document.getElementById('loadingState');
const productCount = document.getElementById('productCount');
const sortSelect = document.getElementById('sortSelect');
const searchInput = document.getElementById('searchInput');
const searchBtn = document.getElementById('searchBtn');
const minPriceInput = document.getElementById('minPrice');
const maxPriceInput = document.getElementById('maxPrice');
const applyPriceBtn = document.getElementById('applyPriceFilter');
const gridViewBtn = document.getElementById('gridView');
const listViewBtn = document.getElementById('listView');

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    initializeObserver();
    initializeEventListeners();
    updateProductCount();
});

// Intersection Observer for animations
function initializeObserver() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
}

// Initialize event listeners
function initializeEventListeners() {
    // View toggle
    gridViewBtn?.addEventListener('click', () => toggleView('grid'));
    listViewBtn?.addEventListener('click', () => toggleView('list'));

    // Sort change
    sortSelect?.addEventListener('change', () => applyFilters());

    // Search
    searchBtn?.addEventListener('click', () => applyFilters());
    searchInput?.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') applyFilters();
    });

    // Price filter
    applyPriceBtn?.addEventListener('click', () => applyFilters());

    // Category filter
    document.querySelectorAll('input[name="category"]').forEach(radio => {
        radio.addEventListener('change', () => applyFilters());
    });

    // Add to cart buttons
    document.addEventListener('click', (e) => {
        if (e.target.classList.contains('add-to-cart-btn')) {
            handleAddToCart(e.target);
        }
        
        if (e.target.classList.contains('quick-view-btn')) {
            handleQuickView(e.target);
        }
        
        if (e.target.closest('.product-card') && !e.target.closest('button')) {
            handleProductClick(e.target.closest('.product-card'));
        }
    });
}

// Apply filters and sorting
async function applyFilters() {
    if (isLoading) return;
    
    isLoading = true;
    showLoading();

    const params = new URLSearchParams();
    
    // Get filter values
    const search = searchInput?.value || '';
    const sort = sortSelect?.value || 'featured';
    const minPrice = minPriceInput?.value || '';
    const maxPrice = maxPriceInput?.value || '';
    const category = document.querySelector('input[name="category"]:checked')?.value || '';

    // Build params
    if (search) params.append('search', search);
    if (sort) params.append('sort', sort);
    if (minPrice) params.append('min_price', minPrice);
    if (maxPrice) params.append('max_price', maxPrice);
    if (category) params.append('category', category);

    try {
        const response = await fetch(`/shop/filter?${params.toString()}`, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        const data = await response.json();

        if (data.success) {
            shopData.products = data.products;
            shopData.total = data.pagination.total;
            shopData.currentPage = data.pagination.current_page;
            shopData.lastPage = data.pagination.last_page;
            
            renderProducts(data.products);
            updateProductCount();
            updateURL(params);
        } else {
            showError('حدث خطأ أثناء تحميل المنتجات');
        }
    } catch (error) {
        console.error('Filter error:', error);
        showError('حدث خطأ في الاتصال');
    } finally {
        hideLoading();
        isLoading = false;
    }
}

// Render products
function renderProducts(products) {
    if (!products || products.length === 0) {
        productsGrid.innerHTML = `
            <div class="empty-products" style="grid-column: 1 / -1;">
                <div class="empty-icon">📦</div>
                <h3>لم يتم العثور على منتجات</h3>
                <p>جرب تغيير معايير البحث أو الفلاتر</p>
            </div>
        `;
        return;
    }

    productsGrid.innerHTML = products.map(product => `
        <div class="product-card fade-in" data-product-id="${product.id}">
            ${getBadgeHTML(product)}
            <div class="product-image">
                <img src="${product.main_image_url || `https://via.placeholder.com/300x280/0e9eff/ffffff?text=${encodeURIComponent(product.name)}`}" 
                     alt="${product.name}"
                     loading="lazy">
                <div class="product-overlay">
                    <button class="quick-view-btn" data-product-id="${product.id}">عرض سريع</button>
                </div>
            </div>
            <div class="product-info">
                <div class="product-category">${product.category}</div>
                <div class="product-rating">
                    <span class="stars">⭐⭐⭐⭐⭐</span>
                    <span class="review-count">(${product.reviews_count})</span>
                </div>
                <h3>${product.name}</h3>
                <p>${product.short_description || 'منتج صحي طبيعي عالي الجودة'}</p>
                <div class="product-footer">
                    <div class="price-wrapper">
                        ${getPriceHTML(product)}
                    </div>
                    <button class="add-to-cart-btn" data-product-id="${product.id}" ${product.stock <= 0 ? 'disabled' : ''}>
                        ${product.stock > 0 ? 'أضف للسلة' : 'نفذ من المخزون'}
                    </button>
                </div>
            </div>
        </div>
    `).join('');

    // Re-initialize observer for new elements
    setTimeout(initializeObserver, 100);
}

// Get badge HTML
function getBadgeHTML(product) {
    if (product.has_discount) {
        return `<span class="product-badge sale">خصم ${product.discount_percentage}%</span>`;
    } else if (product.is_new) {
        return `<span class="product-badge new">جديد</span>`;
    } else if (product.is_featured) {
        return `<span class="product-badge bestseller">الأكثر مبيعاً</span>`;
    }
    return '';
}

// Get price HTML
function getPriceHTML(product) {
    if (product.has_discount) {
        return `
            <span class="old-price">${product.price} MAD</span>
            <span class="price">${product.sales_price} MAD</span>
        `;
    }
    return `<span class="price">${product.price} MAD</span>`;
}

// Handle add to cart
function handleAddToCart(button) {
    if (button.disabled) return;
    
    const productId = button.dataset.productId;
    const originalText = button.textContent;
    
    button.textContent = '✓ تمت الإضافة';
    button.style.background = '#00c853';
    button.disabled = true;

    // Here you would add the actual cart logic
    console.log('Add to cart:', productId);

    setTimeout(() => {
        button.textContent = originalText;
        button.style.background = '';
        button.disabled = false;
    }, 1500);
}

// Handle quick view
function handleQuickView(button) {
    const productId = button.dataset.productId;
    console.log('Quick view for product:', productId);
    // Open quick view modal
}

// Handle product click
function handleProductClick(card) {
    const productId = card.dataset.productId;
    const product = shopData.products.find(p => p.id == productId);
    if (product) {
        // Navigate to product page
        window.location.href = `/product/${product.slug}`;
    }
}

// View toggle
function toggleView(view) {
    if (view === 'grid') {
        productsGrid.classList.remove('list-view');
        gridViewBtn.classList.add('active');
        listViewBtn.classList.remove('active');
    } else {
        productsGrid.classList.add('list-view');
        listViewBtn.classList.add('active');
        gridViewBtn.classList.remove('active');
    }
}

// Update product count
function updateProductCount() {
    if (productCount) {
        productCount.textContent = shopData.total || 0;
    }
}

// Update URL without page reload
function updateURL(params) {
    const newURL = `/shop${params.toString() ? '?' + params.toString() : ''}`;
    window.history.replaceState({}, '', newURL);
}

// Loading states
function showLoading() {
    if (loadingState) {
        loadingState.style.display = 'flex';
    }
    if (productsGrid) {
        productsGrid.style.opacity = '0.5';
    }
}

function hideLoading() {
    if (loadingState) {
        loadingState.style.display = 'none';
    }
    if (productsGrid) {
        productsGrid.style.opacity = '1';
    }
}

// Error handling
function showError(message) {
    alert(message); // Replace with better error handling
}