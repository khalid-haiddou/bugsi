// Get product data from server
const productData = window.productData || {};
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// DOM Elements
const mainImage = document.getElementById('mainImage');
const thumbnails = document.querySelectorAll('.thumbnail');
const quantityInput = document.getElementById('quantity');
const increaseBtn = document.getElementById('increaseQty');
const decreaseBtn = document.getElementById('decreaseQty');
const addToCartBtn = document.getElementById('addToCart');
const buyNowBtn = document.getElementById('buyNow');
const tabButtons = document.querySelectorAll('.tab-btn');
const tabContents = document.querySelectorAll('.tab-content');

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    initializeImageGallery();
    initializeQuantityControls();
    initializeProductActions();
    initializeTabs();
    initializeRelatedProducts();
    updateCartBadge();
});

// Image Gallery
function initializeImageGallery() {
    if (!thumbnails.length) return;
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', () => {
            const imageUrl = thumb.getAttribute('data-image');
            if (mainImage && imageUrl) {
                mainImage.src = imageUrl;
                
                // Update active thumbnail
                thumbnails.forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
            }
        });
    });
}

// Quantity Controls
function initializeQuantityControls() {
    if (!quantityInput) return;
    
    const maxQuantity = parseInt(quantityInput.getAttribute('max')) || 10;
    const minQuantity = parseInt(quantityInput.getAttribute('min')) || 1;
    
    // Increase quantity
    if (increaseBtn) {
        increaseBtn.addEventListener('click', () => {
            const currentValue = parseInt(quantityInput.value) || 1;
            if (currentValue < maxQuantity) {
                quantityInput.value = currentValue + 1;
            }
        });
    }
    
    // Decrease quantity
    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', () => {
            const currentValue = parseInt(quantityInput.value) || 1;
            if (currentValue > minQuantity) {
                quantityInput.value = currentValue - 1;
            }
        });
    }
    
    // Validate input
    quantityInput.addEventListener('input', () => {
        let value = parseInt(quantityInput.value) || 1;
        if (value < minQuantity) value = minQuantity;
        if (value > maxQuantity) value = maxQuantity;
        quantityInput.value = value;
    });

    // Handle direct input
    quantityInput.addEventListener('change', () => {
        let value = parseInt(quantityInput.value) || 1;
        if (value < minQuantity) value = minQuantity;
        if (value > maxQuantity) value = maxQuantity;
        quantityInput.value = value;
    });
}

// Product Actions
function initializeProductActions() {
    // Add to Cart
    if (addToCartBtn && !addToCartBtn.disabled) {
        addToCartBtn.addEventListener('click', () => {
            const quantity = parseInt(quantityInput?.value) || 1;
            const productId = addToCartBtn.dataset.productId || productData.id;
            
            handleAddToCart(productId, quantity);
        });
    }
    
    // Buy Now
    if (buyNowBtn && !buyNowBtn.disabled) {
        buyNowBtn.addEventListener('click', () => {
            const quantity = parseInt(quantityInput?.value) || 1;
            const productId = productData.id;
            
            handleBuyNow(productId, quantity);
        });
    }
}

// Handle Add to Cart
async function handleAddToCart(productId, quantity) {
    if (!productId || quantity <= 0) return;
    
    // Check stock
    if (productData.stock <= 0) {
        showNotification('المنتج غير متوفر في المخزون', 'error');
        return;
    }
    
    const originalText = addToCartBtn.innerHTML;
    const originalBackground = addToCartBtn.style.background;
    
    // Show loading state
    addToCartBtn.innerHTML = '<span>⏳</span> جاري الإضافة...';
    addToCartBtn.disabled = true;
    
    try {
        // Check if cart manager exists
        if (window.cartManager) {
            const cartProduct = {
                id: productData.id,
                name: productData.name,
                price: productData.has_discount ? productData.sales_price : productData.price,
                image: productData.main_image_url,
                category: productData.category,
                quantity: quantity,
                stock: productData.stock
            };
            
            window.cartManager.addItem(cartProduct);
            
            // Success state
            addToCartBtn.innerHTML = '<span>✓</span> تمت الإضافة';
            addToCartBtn.style.background = '#00c853';
            
        } else {
            // Fallback - simulate add to cart
            console.log('Add to cart:', { productId, quantity, productData });
            showNotification('تم إضافة المنتج إلى السلة بنجاح!', 'success');
            
            addToCartBtn.innerHTML = '<span>✓</span> تمت الإضافة';
            addToCartBtn.style.background = '#00c853';
        }
        
        setTimeout(() => {
            addToCartBtn.innerHTML = originalText;
            addToCartBtn.style.background = originalBackground;
            addToCartBtn.disabled = false;
        }, 2000);
        
    } catch (error) {
        console.error('Error adding to cart:', error);
        
        // Error state
        addToCartBtn.innerHTML = '<span>❌</span> حدث خطأ';
        addToCartBtn.style.background = '#ff4757';
        
        setTimeout(() => {
            addToCartBtn.innerHTML = originalText;
            addToCartBtn.style.background = originalBackground;
            addToCartBtn.disabled = false;
        }, 2000);
        
        showNotification('حدث خطأ أثناء إضافة المنتج إلى السلة', 'error');
    }
}

// Handle Buy Now
function handleBuyNow(productId, quantity) {
    if (!productId || quantity <= 0) return;
    
    // Check stock
    if (productData.stock <= 0) {
        showNotification('المنتج غير متوفر في المخزون', 'error');
        return;
    }
    
    console.log('Buy now:', { productId, quantity, productData });
    
    // Add to cart first, then redirect to checkout
    if (window.cartManager) {
        const cartProduct = {
            id: productData.id,
            name: productData.name,
            price: productData.has_discount ? productData.sales_price : productData.price,
            image: productData.main_image_url,
            category: productData.category,
            quantity: quantity,
            stock: productData.stock
        };
        
        window.cartManager.addItem(cartProduct);
        
        // Show loading state
        const originalText = buyNowBtn.textContent;
        buyNowBtn.textContent = 'جاري التحميل...';
        buyNowBtn.disabled = true;
        
        setTimeout(() => {
            // Redirect to cart page
            window.location.href = '/cart';
        }, 1000);
    } else {
        // Fallback
        showNotification('جاري الانتقال إلى صفحة الدفع...', 'info');
        setTimeout(() => {
            window.location.href = '/cart';
        }, 1000);
    }
}

// Tabs Functionality
function initializeTabs() {
    if (!tabButtons.length) return;
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.getAttribute('data-tab');
            
            // Update active tab button
            tabButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            // Show corresponding content
            tabContents.forEach(content => {
                content.classList.remove('active');
                if (content.id === tabName) {
                    content.classList.add('active');
                }
            });
        });
    });
}

// Related Products
function initializeRelatedProducts() {
    const relatedProductCards = document.querySelectorAll('.related-section .product-card');
    
    relatedProductCards.forEach(card => {
        // Add click handler
        card.addEventListener('click', (e) => {
            // Only navigate if not clicking on a button
            if (!e.target.closest('button')) {
                const productLink = card.onclick;
                if (productLink) {
                    productLink.call(card);
                }
            }
        });
        
        // Add hover effects
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.transition = 'transform 0.3s ease';
            card.style.boxShadow = '0 10px 25px rgba(14, 158, 255, 0.15)';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = '';
        });
    });
}

// Update cart badge
function updateCartBadge() {
    if (window.cartManager) {
        window.cartManager.updateCartBadge();
    }
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    Object.assign(notification.style, {
        position: 'fixed',
        top: '20px',
        right: '20px',
        padding: '15px 20px',
        borderRadius: '8px',
        color: 'white',
        fontWeight: '600',
        zIndex: '9999',
        transform: 'translateX(100%)',
        transition: 'transform 0.3s ease',
        background: type === 'success' ? '#00c853' : type === 'error' ? '#ff4757' : type === 'info' ? '#0e9eff' : '#ffa726',
        boxShadow: '0 4px 12px rgba(0,0,0,0.15)',
        fontFamily: 'Cairo, sans-serif',
        direction: 'rtl',
        maxWidth: '300px',
        fontSize: '14px',
        lineHeight: '1.4'
    });
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Update URL in browser (optional)
if (productData.slug && window.location.pathname !== `/product/${productData.slug}`) {
    window.history.replaceState({}, '', `/product/${productData.slug}`);
}

// Listen for cart updates
window.addEventListener('cartUpdated', updateCartBadge);

// Handle page visibility change to update cart badge
document.addEventListener('visibilitychange', () => {
    if (!document.hidden) {
        updateCartBadge();
    }
});

// Image zoom functionality (optional enhancement)
function initializeImageZoom() {
    if (mainImage) {
        mainImage.addEventListener('click', () => {
            // Create zoom overlay
            const overlay = document.createElement('div');
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10000;
                cursor: zoom-out;
            `;
            
            const zoomedImage = document.createElement('img');
            zoomedImage.src = mainImage.src;
            zoomedImage.style.cssText = `
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
            `;
            
            overlay.appendChild(zoomedImage);
            document.body.appendChild(overlay);
            
            overlay.addEventListener('click', () => {
                document.body.removeChild(overlay);
            });
        });
        
        mainImage.style.cursor = 'zoom-in';
    }
}
