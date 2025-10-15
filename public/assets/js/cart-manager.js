// Global Cart Management System
class CartManager {
    constructor() {
        this.cartKey = 'bugsi_cart';
        this.cart = this.loadCart();
        this.discountCode = localStorage.getItem('bugsi_discount_code') || null;
        this.discountAmount = parseFloat(localStorage.getItem('bugsi_discount_amount')) || 0;
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
            if (this.discountCode) {
                localStorage.setItem('bugsi_discount_code', this.discountCode);
                localStorage.setItem('bugsi_discount_amount', this.discountAmount.toString());
            }
            this.updateCartBadge();
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
        this.showNotification(`تم إضافة ${product.name} إلى السلة`);
        return true;
    }

    // Remove item from cart
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

    // Update item quantity
    updateQuantity(productId, quantity) {
        const item = this.cart.find(item => item.id === productId);
        if (item) {
            item.quantity = Math.max(1, Math.min(quantity, item.maxStock));
            this.saveCart();
            return true;
        }
        return false;
    }

    // Get cart total
    getSubtotal() {
        return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    }

    // Get total items count
    getTotalItems() {
        return this.cart.reduce((total, item) => total + item.quantity, 0);
    }

    // Apply coupon
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

    // Clear discount
    clearDiscount() {
        this.discountCode = null;
        this.discountAmount = 0;
        localStorage.removeItem('bugsi_discount_code');
        localStorage.removeItem('bugsi_discount_amount');
        this.saveCart();
    }

    // Get cart data
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

    // Update cart badge in header
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

    // Clear cart
    clearCart() {
        this.cart = [];
        this.clearDiscount();
        this.saveCart();
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
}

// Initialize global cart manager
if (!window.cartManager) {
    window.cartManager = new CartManager();
}