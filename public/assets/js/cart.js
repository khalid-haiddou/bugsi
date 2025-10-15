// Cart Management System using localStorage
class CartManager {
    constructor() {
        this.cartKey = 'bugsi_cart';
        this.cart = this.loadCart();
        this.discountCode = null;
        this.discountAmount = 0;
        this.init();
    }

    init() {
        const initialize = () => {
            this.renderCart();
            this.bindEvents();
            this.updateCartDisplay();
            this.updateCartBadge();
        };
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initialize, { once: true });
        } else {
            initialize();
        }
    }

    // Load cart from localStorage
    loadCart() {
        try {
            const cartData = localStorage.getItem(this.cartKey);
            return cartData ? JSON.parse(cartData) : [];
        } catch (error) {
            console.error('Error loading cart:', error);
            return [];
        }
    }

    // Save cart to localStorage
    saveCart() {
        try {
            localStorage.setItem(this.cartKey, JSON.stringify(this.cart));
            this.updateCartBadge();
            try {
                window.dispatchEvent(new CustomEvent('cartUpdated', { detail: this.getCartData() }));
            } catch (e) {
                // ignore
            }
        } catch (error) {
            console.error('Error saving cart:', error);
        }
    }

    // Add item to cart
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
        this.renderCart();
        this.updateCartDisplay();
        this.showNotification(`تم إضافة ${product.name} إلى السلة`);
    }

    // Remove item from cart
    removeItem(productId) {
        const itemIndex = this.cart.findIndex(item => item.id === productId);
        if (itemIndex > -1) {
            const itemName = this.cart[itemIndex].name;
            this.cart.splice(itemIndex, 1);
            this.saveCart();
            this.renderCart();
            this.updateCartDisplay();
            this.showNotification(`تم حذف ${itemName} من السلة`);
        }
    }

    // Update item quantity
    updateQuantity(productId, quantity) {
        const item = this.cart.find(item => item.id === productId);
        if (item) {
            item.quantity = Math.max(1, Math.min(quantity, item.maxStock));
            this.saveCart();
            this.updateCartDisplay();
        }
    }

    // Get cart total
    getSubtotal() {
        return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    }

    // Get total items count
    getTotalItems() {
        return this.cart.reduce((total, item) => total + item.quantity, 0);
    }

    // Render cart items
    renderCart() {
        const cartItems = document.getElementById('cartItems');
        const cartLayout = document.getElementById('cartLayout');
        const emptyCart = document.getElementById('emptyCart');
        const cartLoading = document.getElementById('cartLoading');

        // Not on cart page
        if (!cartItems || !cartLayout || !emptyCart) {
            return;
        }

        // Hide loading if present
        if (cartLoading) {
            cartLoading.style.display = 'none';
        }

        if (this.cart.length === 0) {
            cartLayout.style.display = 'none';
            emptyCart.style.display = 'block';
            return;
        }

        cartLayout.style.display = 'flex';
        emptyCart.style.display = 'none';

        cartItems.innerHTML = this.cart.map(item => `
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
                    <div class="item-total">المجموع: <span class="item-subtotal">${item.price * item.quantity}</span> MAD</div>
                </div>
            </div>
        `).join('');

        this.bindItemEvents();
    }

    // Bind events for cart items
    bindItemEvents() {
        // Quantity increase
        document.querySelectorAll('.increase-qty').forEach(btn => {
            btn.addEventListener('click', () => {
                const productId = parseInt(btn.dataset.id);
                const item = this.cart.find(item => item.id === productId);
                if (item && item.quantity < item.maxStock) {
                    this.updateQuantity(productId, item.quantity + 1);
                    this.renderCart();
                }
            });
        });

        // Quantity decrease
        document.querySelectorAll('.decrease-qty').forEach(btn => {
            btn.addEventListener('click', () => {
                const productId = parseInt(btn.dataset.id);
                const item = this.cart.find(item => item.id === productId);
                if (item && item.quantity > 1) {
                    this.updateQuantity(productId, item.quantity - 1);
                    this.renderCart();
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
                        this.removeItem(productId);
                    }, 300);
                }
            });
        });
    }

    // Bind main events
    bindEvents() {
        // Apply coupon
        const applyCouponBtn = document.getElementById('applyCoupon');
        const couponInput = document.getElementById('couponInput');

        applyCouponBtn?.addEventListener('click', () => {
            this.applyCoupon(couponInput.value.trim());
        });

        couponInput?.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.applyCoupon(couponInput.value.trim());
            }
        });

        // Checkout
        const checkoutBtn = document.getElementById('checkoutBtn');
        checkoutBtn?.addEventListener('click', () => {
            this.checkout();
        });
    }

    // Apply coupon code
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
            
            document.getElementById('discountRow').style.display = 'flex';
            document.getElementById('discount').textContent = `-${this.discountAmount.toFixed(2)} MAD`;
            document.getElementById('couponInput').value = '';
            
            this.updateCartDisplay();
            this.showSuccessMessage(`تم تطبيق كود الخصم ${upperCode} (${validCoupons[upperCode]}%)`);
        } else if (code) {
            this.showNotification('كود الخصم غير صالح', 'error');
        }
    }

    // Update cart display totals
    updateCartDisplay() {
        const subtotal = this.getSubtotal();
        const total = subtotal - this.discountAmount;
        const itemCount = this.getTotalItems();

        const subtotalEl = document.getElementById('subtotal');
        const totalEl = document.getElementById('total');
        const itemCountEl = document.getElementById('itemCount');

        if (subtotalEl) subtotalEl.textContent = `${subtotal.toFixed(2)} MAD`;
        if (totalEl) totalEl.textContent = `${total.toFixed(2)} MAD`;
        if (itemCountEl) itemCountEl.textContent = itemCount;
    }

    // Update cart badge in header
    updateCartBadge() {
        const cartBadge = document.querySelector('.cart-badge');
        const cartCount = document.querySelector('.cart-count');
        const itemCount = this.getTotalItems();
        
        if (cartBadge) {
            cartBadge.textContent = itemCount;
            cartBadge.style.display = itemCount > 0 ? 'block' : 'none';
        }
        
        if (cartCount) {
            cartCount.textContent = itemCount;
        }
    }

    // Show success message
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

    // Show notification
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
            fontFamily: 'Cairo, sans-serif'
        });
        
        document.body.appendChild(notification);
        
        setTimeout(() => notification.style.transform = 'translateX(0)', 100);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => document.body.removeChild(notification), 300);
        }, 3000);
    }

    // Checkout process
    checkout() {
        if (this.cart.length === 0) {
            this.showNotification('السلة فارغة', 'error');
            return;
        }

        const total = this.getSubtotal() - this.discountAmount;
        console.log('Checkout data:', {
            items: this.cart,
            subtotal: this.getSubtotal(),
            discount: this.discountAmount,
            total: total,
            coupon: this.discountCode
        });

        this.showNotification('جاري الانتقال إلى صفحة الدفع...');
        
        // Here you would redirect to checkout page
        // window.location.href = '/checkout';
    }

    // Clear cart
    clearCart() {
        this.cart = [];
        this.discountCode = null;
        this.discountAmount = 0;
        this.saveCart();
        this.renderCart();
        this.updateCartDisplay();
    }

    // Get cart data (for external use)
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
}

// Initialize singleton
if (!window.cartManager) {
    window.cartManager = new CartManager();
} else if (typeof window.cartManager.updateCartBadge === 'function') {
    window.cartManager.updateCartBadge();
}

// Add CSS animations
let style = document.getElementById('cartManagerStyles');
if (!style) {
    style = document.createElement('style');
    style.id = 'cartManagerStyles';
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
}