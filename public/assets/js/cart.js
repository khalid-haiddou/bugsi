// Cart Page Controller - Updated to work with existing cart manager
class CartPageController {
    constructor() {
        // Wait for cartManager to be available
        this.waitForCartManager().then(() => {
            this.cartManager = window.cartManager;
            this.init();
        });
    }

    async waitForCartManager() {
        // Wait for cart manager to be available
        return new Promise((resolve) => {
            if (window.cartManager) {
                resolve();
            } else {
                // If cart manager not available, create it
                if (!window.CartManager) {
                    // Include cart manager inline since it's not loaded
                    this.createCartManager();
                }
                window.cartManager = new CartManager();
                resolve();
            }
        });
    }

    createCartManager() {
        // Inline CartManager for when the separate file isn't loaded
        window.CartManager = class CartManager {
            constructor() {
                this.cartKey = 'bugsi_cart';
                this.cart = this.loadCart();
                this.discountCode = localStorage.getItem('bugsi_discount_code') || null;
                this.discountAmount = parseFloat(localStorage.getItem('bugsi_discount_amount')) || 0;
            }

            loadCart() {
                try {
                    const cartData = localStorage.getItem(this.cartKey);
                    return cartData ? JSON.parse(cartData) : [];
                } catch (error) {
                    console.error('Error loading cart:', error);
                    return [];
                }
            }

            saveCart() {
                try {
                    localStorage.setItem(this.cartKey, JSON.stringify(this.cart));
                    if (this.discountCode) {
                        localStorage.setItem('bugsi_discount_code', this.discountCode);
                        localStorage.setItem('bugsi_discount_amount', this.discountAmount.toString());
                    }
                    this.updateCartBadge();
                } catch (error) {
                    console.error('Error saving cart:', error);
                }
            }

            addItem(product) {
                const existingItem = this.cart.find(item => item.id === product.id);
                
                if (existingItem) {
                    existingItem.quantity += product.quantity || 1;
                } else {
                    this.cart.push({
                        id: product.id,
                        name: product.name,
                        price: product.price,
                        image: product.image || product.main_image_url,
                        category: product.category,
                        quantity: product.quantity || 1,
                        maxStock: product.stock || 10
                    });
                }
                
                this.saveCart();
                this.showNotification(`تم إضافة ${product.name} إلى السلة`);
                return true;
            }

            removeItem(productId) {
                const itemIndex = this.cart.findIndex(item => item.id === productId);
                if (itemIndex > -1) {
                    const itemName = this.cart[itemIndex].name;
                    this.cart.splice(itemIndex, 1);
                    this.saveCart();
                    this.showNotification(`تم حذف ${itemName} من السلة`);
                    return true;
                }
                return false;
            }

            updateQuantity(productId, quantity) {
                const item = this.cart.find(item => item.id === productId);
                if (item) {
                    item.quantity = Math.max(1, Math.min(quantity, item.maxStock));
                    this.saveCart();
                    return true;
                }
                return false;
            }

            getSubtotal() {
                return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
            }

            getTotalItems() {
                return this.cart.reduce((total, item) => total + item.quantity, 0);
            }

            applyCoupon(code) {
                const validCoupons = {
                    'BUGSI10': 10,
                    'SAVE20': 20,
                    'SUMMER25': 25,
                    'WELCOME15': 15
                };

                const upperCode = code.toUpperCase();
                
                if (validCoupons[upperCode]) {
                    this.discountCode = upperCode;
                    this.discountAmount = (this.getSubtotal() * validCoupons[upperCode]) / 100;
                    this.saveCart();
                    return {
                        success: true,
                        discount: this.discountAmount,
                        percentage: validCoupons[upperCode]
                    };
                }
                
                return { success: false, message: 'كود الخصم غير صالح' };
            }

            getCartData() {
                return {
                    items: this.cart,
                    subtotal: this.getSubtotal(),
                    discount: this.discountAmount,
                    total: this.getSubtotal() - this.discountAmount,
                    itemCount: this.getTotalItems(),
                    coupon: this.discountCode
                };
            }

            updateCartBadge() {
                const cartBadges = document.querySelectorAll('.cart-badge, .cart-count');
                const itemCount = this.getTotalItems();
                
                cartBadges.forEach(badge => {
                    if (badge) {
                        badge.textContent = itemCount;
                        badge.style.display = itemCount > 0 ? 'inline-block' : 'none';
                    }
                });
            }

            clearCart() {
                this.cart = [];
                this.discountCode = null;
                this.discountAmount = 0;
                localStorage.removeItem('bugsi_discount_code');
                localStorage.removeItem('bugsi_discount_amount');
                this.saveCart();
            }

            showNotification(message, type = 'success') {
                const notification = document.createElement('div');
                notification.className = `cart-notification ${type}`;
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
                    background: type === 'success' ? '#00c853' : '#ff4757',
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
        };
    }

    init() {
        console.log('Cart page initialized with cart:', this.cartManager.cart);
        this.renderCart();
        this.bindEvents();
        this.updateCartDisplay();
    }

    renderCart() {
        const cartItems = document.getElementById('cartItems');
        const cartLayout = document.getElementById('cartLayout');
        const emptyCart = document.getElementById('emptyCart');
        const cartLoading = document.getElementById('cartLoading');

        // Hide loading
        if (cartLoading) cartLoading.style.display = 'none';

        const cart = this.cartManager.cart;
        console.log('Rendering cart with items:', cart);

        if (cart.length === 0) {
            if (cartLayout) cartLayout.style.display = 'none';
            if (emptyCart) emptyCart.style.display = 'block';
            return;
        }

        if (cartLayout) cartLayout.style.display = 'flex';
        if (emptyCart) emptyCart.style.display = 'none';

        if (cartItems) {
            cartItems.innerHTML = cart.map(item => `
                <div class="cart-item" data-id="${item.id}">
                    <div class="item-image">
                        <img src="${item.image || 'https://via.placeholder.com/120x120/0e9eff/ffffff?text=' + encodeURIComponent(item.name)}" 
                             alt="${item.name}"
                             onerror="this.src='https://via.placeholder.com/120x120/0e9eff/ffffff?text=' + encodeURIComponent('${item.name}')">
                    </div>
                    <div class="item-details">
                        <div>
                            <h3 class="item-name">${item.name}</h3>
                            <p class="item-category">${item.category || 'منتج صحي'}</p>
                        </div>
                        <div class="item-controls">
                            <div class="quantity-controls">
                                <button class="quantity-btn decrease-qty" data-id="${item.id}">-</button>
                                <input type="number" class="quantity-input" value="${item.quantity}" min="1" max="${item.maxStock}" readonly>
                                <button class="quantity-btn increase-qty" data-id="${item.id}">+</button>
                            </div>
                            <button class="remove-btn" data-id="${item.id}">
                                <span>🗑️</span>
                                حذف
                            </button>
                        </div>
                    </div>
                    <div class="item-pricing">
                        <div class="item-price">${item.price} MAD</div>
                        <div class="item-total">المجموع: <span class="item-subtotal">${(item.price * item.quantity).toFixed(2)}</span> MAD</div>
                    </div>
                </div>
            `).join('');
        }

        this.bindItemEvents();
    }

    bindItemEvents() {
        // Quantity increase
        document.querySelectorAll('.increase-qty').forEach(btn => {
            btn.addEventListener('click', () => {
                const productId = parseInt(btn.dataset.id);
                const item = this.cartManager.cart.find(item => item.id === productId);
                if (item && item.quantity < item.maxStock) {
                    this.cartManager.updateQuantity(productId, item.quantity + 1);
                    this.renderCart();
                    this.updateCartDisplay();
                }
            });
        });

        // Quantity decrease
        document.querySelectorAll('.decrease-qty').forEach(btn => {
            btn.addEventListener('click', () => {
                const productId = parseInt(btn.dataset.id);
                const item = this.cartManager.cart.find(item => item.id === productId);
                if (item && item.quantity > 1) {
                    this.cartManager.updateQuantity(productId, item.quantity - 1);
                    this.renderCart();
                    this.updateCartDisplay();
                }
            });
        });

        // Remove item
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const productId = parseInt(btn.dataset.id);
                if (confirm('هل تريد حذف هذا المنتج من السلة؟')) {
                    const cartItem = btn.closest('.cart-item');
                    cartItem.style.animation = 'slideOut 0.3s ease-out';
                    setTimeout(() => {
                        this.cartManager.removeItem(productId);
                        this.renderCart();
                        this.updateCartDisplay();
                    }, 300);
                }
            });
        });
    }

    bindEvents() {
        // Apply coupon
        const applyCouponBtn = document.getElementById('applyCoupon');
        const couponInput = document.getElementById('couponInput');

        if (applyCouponBtn) {
            applyCouponBtn.addEventListener('click', () => {
                this.applyCoupon(couponInput?.value.trim() || '');
            });
        }

        if (couponInput) {
            couponInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    this.applyCoupon(couponInput.value.trim());
                }
            });
        }

        // Checkout
        const checkoutBtn = document.getElementById('checkoutBtn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', () => {
                this.checkout();
            });
        }
    }

    applyCoupon(code) {
        const result = this.cartManager.applyCoupon(code);
        
        if (result.success) {
            const discountRow = document.getElementById('discountRow');
            const discountEl = document.getElementById('discount');
            
            if (discountRow) discountRow.style.display = 'flex';
            if (discountEl) discountEl.textContent = `-${result.discount.toFixed(2)} MAD`;
            
            const couponInput = document.getElementById('couponInput');
            if (couponInput) couponInput.value = '';
            
            this.updateCartDisplay();
            this.showSuccessMessage(`تم تطبيق كود الخصم ${code.toUpperCase()} (${result.percentage}%)`);
        } else {
            this.cartManager.showNotification(result.message, 'error');
        }
    }

    updateCartDisplay() {
        const cartData = this.cartManager.getCartData();
        
        const subtotalEl = document.getElementById('subtotal');
        const totalEl = document.getElementById('total');
        const itemCountEl = document.getElementById('itemCount');
        
        if (subtotalEl) subtotalEl.textContent = `${cartData.subtotal.toFixed(2)} MAD`;
        if (totalEl) totalEl.textContent = `${cartData.total.toFixed(2)} MAD`;
        if (itemCountEl) itemCountEl.textContent = cartData.itemCount;

        // Show discount if exists
        if (this.cartManager.discountAmount > 0) {
            const discountRow = document.getElementById('discountRow');
            const discountEl = document.getElementById('discount');
            
            if (discountRow) discountRow.style.display = 'flex';
            if (discountEl) discountEl.textContent = `-${this.cartManager.discountAmount.toFixed(2)} MAD`;
        }
    }

    showSuccessMessage(message) {
        const successMessage = document.getElementById('successMessage');
        const successText = document.getElementById('successText');
        
        if (successMessage && successText) {
            successText.textContent = message;
            successMessage.classList.add('show');
            
            setTimeout(() => {
                successMessage.classList.remove('show');
            }, 3000);
        }
    }

    checkout() {
        const cartData = this.cartManager.getCartData();
        
        if (cartData.itemCount === 0) {
            this.cartManager.showNotification('السلة فارغة', 'error');
            return;
        }

        console.log('Checkout data:', cartData);
        this.cartManager.showNotification('جاري الانتقال إلى صفحة الدفع...');
        
        // Here you would redirect to checkout page
        // window.location.href = '/checkout';
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('Cart page DOM loaded');
    new CartPageController();
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideOut {
        to {
            opacity: 0;
            transform: translateX(-20px);
        }
    }
    
    .success-message {
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }
    
    .success-message.show {
        opacity: 1;
        transform: translateY(0);
    }
    
    .cart-loading {
        text-align: center;
        padding: 50px;
    }
    
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #0e9eff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 15px;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .discount-value {
        color: #00c853 !important;
    }
`;
document.head.appendChild(style);