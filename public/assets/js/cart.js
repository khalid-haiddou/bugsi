// Update cart totals
        function updateCart() {
            const items = document.querySelectorAll('.cart-item');
            let subtotal = 0;
            let itemCount = 0;

            items.forEach(item => {
                const price = parseFloat(item.dataset.price);
                const quantity = parseInt(item.querySelector('.quantity-input').value);
                const itemSubtotal = price * quantity;
                
                item.querySelector('.item-subtotal').textContent = itemSubtotal;
                subtotal += itemSubtotal;
                itemCount += quantity;
            });

            document.getElementById('subtotal').textContent = `${subtotal} dhs`;
            document.getElementById('itemCount').textContent = itemCount;

            // Apply discount if exists
            const discountRow = document.getElementById('discountRow');
            let discount = 0;
            if (discountRow.style.display !== 'none') {
                discount = parseFloat(document.getElementById('discount').textContent.replace('-', '').replace(' dhs', ''));
            }

            const total = subtotal - discount;
            document.getElementById('total').textContent = `${total} dhs`;

            // Show empty cart if no items
            if (items.length === 0) {
                document.getElementById('cartLayout').style.display = 'none';
                document.getElementById('emptyCart').style.display = 'block';
            }
        }

        // Quantity controls
        document.querySelectorAll('.increase-qty').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = btn.parentElement.querySelector('.quantity-input');
                const currentValue = parseInt(input.value);
                const maxValue = parseInt(input.getAttribute('max'));
                
                if (currentValue < maxValue) {
                    input.value = currentValue + 1;
                    updateCart();
                }
            });
        });

        document.querySelectorAll('.decrease-qty').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = btn.parentElement.querySelector('.quantity-input');
                const currentValue = parseInt(input.value);
                const minValue = parseInt(input.getAttribute('min'));
                
                if (currentValue > minValue) {
                    input.value = currentValue - 1;
                    updateCart();
                }
            });
        });

        // Remove item
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const item = btn.closest('.cart-item');
                item.style.animation = 'slideOut 0.3s ease-out';
                
                setTimeout(() => {
                    item.remove();
                    updateCart();
                }, 300);
            });
        });

        // Apply coupon
        document.getElementById('applyCoupon').addEventListener('click', () => {
            const couponInput = document.getElementById('couponInput');
            const couponCode = couponInput.value.trim().toUpperCase();
            
            // Example coupon codes
            const validCoupons = {
                'BUGSI10': 10,
                'SAVE20': 20,
                'SUMMER25': 25
            };

            if (validCoupons[couponCode]) {
                const subtotal = parseFloat(document.getElementById('subtotal').textContent.replace(' dhs', ''));
                const discountPercent = validCoupons[couponCode];
                const discountAmount = (subtotal * discountPercent) / 100;

                document.getElementById('discountRow').style.display = 'flex';
                document.getElementById('discount').textContent = `-${discountAmount} dhs`;
                
                const total = subtotal - discountAmount;
                document.getElementById('total').textContent = `${total} dhs`;

                // Show success message
                const successMessage = document.getElementById('successMessage');
                successMessage.classList.add('show');
                couponInput.value = '';

                setTimeout(() => {
                    successMessage.classList.remove('show');
                }, 3000);
            } else if (couponCode) {
                alert('كود الخصم غير صالح');
            }
        });

        // Checkout
        document.getElementById('checkoutBtn').addEventListener('click', () => {
            console.log('Proceed to checkout');
            alert('جاري الانتقال إلى صفحة الدفع...');
            // window.location.href = '/checkout';
        });

        // Animation for item removal
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideOut {
                to {
                    opacity: 0;
                    transform: translateX(-20px);
                }
            }
        `;
        document.head.appendChild(style);

        // Initial cart update
        updateCart();
