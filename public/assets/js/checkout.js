        // Cart Data (In real app, this would come from backend/session)
        const cartData = {
            items: [
                { name: 'MMS - محلول معدني معجزة', quantity: 2, price: 150 },
                { name: 'CDS - محلول الكلور المركز', quantity: 1, price: 220 }
            ]
        };

        // Calculate totals
        function calculateTotals() {
            let subtotal = 0;
            
            cartData.items.forEach(item => {
                subtotal += item.price * item.quantity;
            });

            // Delivery logic: free shipping if total >= 200 dhs, otherwise 40 dhs
            const shippingFee = subtotal >= 200 ? 0 : 40;
            const total = subtotal + shippingFee;

            // Update UI
            document.getElementById('subtotal').textContent = subtotal + ' dhs';
            
            const shippingElement = document.getElementById('shipping');
            if (shippingFee === 0) {
                shippingElement.textContent = 'مجاناً';
                shippingElement.style.color = 'var(--success)';
            } else {
                shippingElement.textContent = shippingFee + ' dhs';
                shippingElement.style.color = 'var(--text-dark)';
            }

            document.getElementById('total').textContent = total + ' dhs';

            // Update shipping notice
            const notice = document.getElementById('shippingNotice');
            if (shippingFee === 0) {
                notice.className = 'shipping-notice';
                notice.innerHTML = `
                    <div class="shipping-notice-icon">✓</div>
                    <div class="shipping-notice-text">
                        <strong>مبروك!</strong> حصلت على شحن مجاني
                    </div>
                `;
            } else {
                const remaining = 200 - subtotal;
                notice.className = 'shipping-notice warning';
                notice.innerHTML = `
                    <div class="shipping-notice-icon">⚠️</div>
                    <div class="shipping-notice-text">
                        أضف <strong>${remaining} dhs</strong> أخرى للحصول على شحن مجاني
                    </div>
                `;
            }

            return { subtotal, shippingFee, total };
        }

        // Phone Number Formatting
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (!value.startsWith('212')) {
                    value = '212' + value;
                }
            }
            e.target.value = value ? '+' + value : '';
        });

        // Form Validation
        const form = document.getElementById('checkoutForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Validate all required fields
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('error');
                    isValid = false;
                } else {
                    field.classList.remove('error');
                }
            });

            if (!isValid) {
                alert('يرجى ملء جميع الحقول المطلوبة');
                return;
            }

            // Get form data
            const formData = new FormData(form);
            const orderData = {
                first_name: formData.get('first_name'),
                last_name: formData.get('last_name'),
                phone: formData.get('phone'),
                city: formData.get('city'),
                address: formData.get('address'),
                notes: formData.get('notes'),
                ...calculateTotals(),
                items: cartData.items
            };

            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.textContent = 'جاري معالجة الطلب...';

            // Simulate API call
            setTimeout(() => {
                console.log('Order data:', orderData);
                
                // Redirect to success page
                // window.location.href = '/order-success?order_id=12345';
                
                alert('تم استلام طلبك بنجاح! سيتم التواصل معك قريباً');
                
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.textContent = 'تأكيد الطلب';
            }, 2000);
        });

        // Clear error on input
        const inputs = form.querySelectorAll('.form-input, .form-select, .form-textarea');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        });

        // Initialize
        calculateTotals();
