// Get CSRF token
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// Shop data from server
let shopData = window.shopData || { products: [], currentPage: 1, lastPage: 1, total: 0 };
let isLoading = false;

// DOM elements
const productsGrid = document.getElementById('productsGrid');
const productCount = document.getElementById('productCount');
const sortSelect = document.getElementById('sortSelect');
const gridViewBtn = document.getElementById('gridView');
const listViewBtn = document.getElementById('listView');

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    initializeObserver();
    initializeEventListeners();
    updateProductCount();
    handlePagination();
    updateCartBadge();
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
    sortSelect?.addEventListener('change', () => applySorting());

    // Product interactions - delegate events for dynamic content
    document.addEventListener('click', (e) => {
        // Handle add to cart button clicks
        if (e.target.classList.contains('add-to-cart-btn') || e.target.closest('.add-to-cart-btn')) {
            e.preventDefault();
            e.stopPropagation();
            const button = e.target.classList.contains('add-to-cart-btn') ? e.target : e.target.closest('.add-to-cart-btn');
            handleAddToCart(button);
        }
        
        // Handle product card clicks (but not if clicking on buttons)
        if (e.target.closest('.product-card') && !e.target.closest('button')) {
            handleProductClick(e.target.closest('.product-card'));
        }
    });
}

// Apply sorting
async function applySorting() {
    if (isLoading || !sortSelect) return;
    
    isLoading = true;
    showLoadingState();

    const params = new URLSearchParams();
    const sort = sortSelect.value || 'featured';
    
    if (sort) params.append('sort', sort);

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
        console.error('Sort error:', error);
        showError('حدث خطأ في الاتصال');
    } finally {
        hideLoadingState();
        isLoading = false;
    }
}

// Render products (for dynamic updates via sorting)
function renderProducts(products) {
    if (!productsGrid) return;
    
    if (!products || products.length === 0) {
        productsGrid.innerHTML = `
            <div class="empty-products" style="grid-column: 1 / -1;">
                <div class="empty-icon">📦</div>
                <h3>لم يتم العثور على منتجات</h3>
                <p>لا توجد منتجات متاحة حالياً</p>
            </div>
        `;
        return;
    }

    productsGrid.innerHTML = products.map(product => `
        <div class="product-card fade-in clickable-card" 
             data-product-id="${product.id}"
             data-product-slug="${product.slug}"
             onclick="navigateToProduct('${product.slug}')">
             
            ${getBadgeHTML(product)}
            <div class="product-image">
                <img src="${product.main_image_url || `https://via.placeholder.com/300x300/0e9eff/ffffff?text=${encodeURIComponent(product.name)}`}" 
                     alt="${product.name}"
                     loading="lazy">
            </div>
            <div class="product-info">
                <div class="product-category">${product.category}</div>
                <div class="product-rating">
                    <span class="stars">⭐⭐⭐⭐⭐</span>
                    <span class="review-count">(${product.reviews_count || 0})</span>
                </div>
                <h3>${product.name}</h3>
                <p>${product.short_description || 'منتج صحي طبيعي عالي الجودة'}</p>
                <div class="product-footer">
                    <div class="price-wrapper">
                        ${getPriceHTML(product)}
                    </div>
                    <button class="add-to-cart-btn" 
                            data-product-id="${product.id}"
                            onclick="event.stopPropagation(); return false;"
                            ${product.stock <= 0 ? 'disabled' : ''}>
                        ${product.stock > 0 ? 'أضف للسلة' : 'نفذ من المخزون'}
                    </button>
                </div>
            </div>
        </div>
    `).join('');

    // Re-initialize observer for new elements
    setTimeout(() => {
        initializeObserver();
    }, 100);
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
    if (product.has_discount && product.sales_price) {
        return `
            <span class="old-price">${product.price} MAD</span>
            <span class="price">${product.sales_price} MAD</span>
        `;
    }
    return `<span class="price">${product.final_price || product.price} MAD</span>`;
}

// Handle add to cart
function handleAddToCart(button) {
    if (button.disabled) return;
    
    const productId = parseInt(button.dataset.productId);
    const product = shopData.products.find(p => p.id === productId);
    
    if (!product) {
        showNotification('منتج غير موجود', 'error');
        return;
    }
    
    if (product.stock <= 0) {
        showNotification('المنتج غير متوفر في المخزون', 'error');
        return;
    }
    
    const originalText = button.textContent;
    const originalBackground = button.style.background;
    
    // Show loading state
    button.textContent = 'جاري الإضافة...';
    button.disabled = true;

    // Add to cart using cart manager
    if (window.cartManager) {
        const cartProduct = {
            id: product.id,
            name: product.name,
            price: product.has_discount ? product.sales_price : product.price,
            image: product.main_image_url,
            category: product.category,
            quantity: 1,
            stock: product.stock
        };
        
        window.cartManager.addItem(cartProduct);
        
        // Show success state
        button.textContent = '✓ تمت الإضافة';
        button.style.background = '#00c853';
        
        setTimeout(() => {
            button.textContent = originalText;
            button.style.background = originalBackground;
            button.disabled = false;
        }, 1500);
    } else {
        // Fallback if cart manager not loaded
        console.log('Add to cart - Product ID:', productId);
        showNotification('تم إضافة المنتج إلى السلة بنجاح!', 'success');
        
        // Show success state
        button.textContent = '✓ تمت الإضافة';
        button.style.background = '#00c853';
        
        setTimeout(() => {
            button.textContent = originalText;
            button.style.background = originalBackground;
            button.disabled = false;
        }, 1500);
    }
}

// Product navigation function (global for onclick)
function navigateToProduct(slug) {
    if (slug) {
        window.location.href = `/product/${slug}`;
    }
}

// Handle product click navigation
function handleProductClick(card) {
    const productSlug = card.dataset.productSlug;
    const productId = card.dataset.productId;
    
    if (productSlug) {
        window.location.href = `/product/${productSlug}`;
    } else if (productId) {
        window.location.href = `/product/${productId}`;
    }
}

// View toggle functionality
function toggleView(view) {
    if (!productsGrid || !gridViewBtn || !listViewBtn) return;
    
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

// Update product count display
function updateProductCount() {
    if (productCount) {
        productCount.textContent = shopData.total || 0;
    }
}

// Update cart badge
function updateCartBadge() {
    if (window.cartManager) {
        window.cartManager.updateCartBadge();
    }
}

// Update URL without page reload
function updateURL(params) {
    const newURL = `/shop${params.toString() ? '?' + params.toString() : ''}`;
    window.history.replaceState({}, '', newURL);
}

// Loading states
function showLoadingState() {
    if (productsGrid) {
        productsGrid.style.opacity = '0.6';
        productsGrid.style.pointerEvents = 'none';
    }
}

function hideLoadingState() {
    if (productsGrid) {
        productsGrid.style.opacity = '1';
        productsGrid.style.pointerEvents = 'auto';
    }
}

// Simple notification system
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    Object.assign(notification.style, {
        position: 'fixed',
        top: '20px',
        right: '20px',
        padding: '12px 20px',
        borderRadius: '8px',
        color: 'white',
        fontWeight: '600',
        fontSize: '14px',
        zIndex: '9999',
        transform: 'translateX(100%)',
        transition: 'transform 0.3s ease',
        background: type === 'success' ? '#00c853' : type === 'error' ? '#ff4757' : '#0e9eff',
        boxShadow: '0 4px 12px rgba(0,0,0,0.15)',
        fontFamily: 'Cairo, sans-serif',
        direction: 'rtl'
    });
    
    document.body.appendChild(notification);
    
    setTimeout(() => notification.style.transform = 'translateX(0)', 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Error handling
function showError(message) {
    showNotification(message, 'error');
}

// Pagination handling
function handlePagination() {
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const url = new URL(link.href);
            const page = url.searchParams.get('page');
            if (page) {
                loadPage(page);
            }
        });
    });
}

// Load specific page
async function loadPage(page) {
    if (isLoading) return;
    
    isLoading = true;
    showLoadingState();
    
    try {
        const currentParams = new URLSearchParams(window.location.search);
        currentParams.set('page', page);
        
        const response = await fetch(`/shop?${currentParams.toString()}`, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        
        if (response.ok) {
            // Reload the page with new data
            window.location.href = `/shop?${currentParams.toString()}`;
        }
    } catch (error) {
        console.error('Pagination error:', error);
        showError('حدث خطأ أثناء تحميل الصفحة');
    } finally {
        hideLoadingState();
        isLoading = false;
    }
}

// Smooth scroll to top
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Listen for cart updates
window.addEventListener('cartUpdated', updateCartBadge);