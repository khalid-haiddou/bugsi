        // Image Gallery
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', () => {
                const imageUrl = thumb.getAttribute('data-image');
                mainImage.src = imageUrl;
                
                thumbnails.forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
            });
        });

        // Quantity Controls
        const quantityInput = document.getElementById('quantity');
        const increaseBtn = document.getElementById('increaseQty');
        const decreaseBtn = document.getElementById('decreaseQty');

        increaseBtn.addEventListener('click', () => {
            const currentValue = parseInt(quantityInput.value);
            const maxValue = parseInt(quantityInput.getAttribute('max'));
            if (currentValue < maxValue) {
                quantityInput.value = currentValue + 1;
            }
        });

        decreaseBtn.addEventListener('click', () => {
            const currentValue = parseInt(quantityInput.value);
            const minValue = parseInt(quantityInput.getAttribute('min'));
            if (currentValue > minValue) {
                quantityInput.value = currentValue - 1;
            }
        });

        // Add to Cart
        const addToCartBtn = document.getElementById('addToCart');
        addToCartBtn.addEventListener('click', () => {
            const quantity = quantityInput.value;
            const originalText = addToCartBtn.innerHTML;
            
            addToCartBtn.innerHTML = '<span>✓</span> تمت الإضافة';
            addToCartBtn.style.background = '#00c853';
            
            setTimeout(() => {
                addToCartBtn.innerHTML = originalText;
                addToCartBtn.style.background = '';
            }, 2000);
            
            console.log(`Added ${quantity} item(s) to cart`);
        });

        // Buy Now
        const buyNowBtn = document.getElementById('buyNow');
        buyNowBtn.addEventListener('click', () => {
            console.log('Proceed to checkout');
            // window.location.href = '/checkout';
        });

        // Tabs
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabName = button.getAttribute('data-tab');
                
                tabButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                tabContents.forEach(content => {
                    content.classList.remove('active');
                    if (content.id === tabName) {
                        content.classList.add('active');
                    }
                });
            });
        });

        // Related Products Click
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', () => {
                console.log('Navigate to product');
                // window.location.href = '/product/slug';
            });
        });
