        // Add to cart functionality
        let cartCount = 0;
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const originalText = button.textContent;
                button.textContent = '✓ تمت الإضافة';
                button.style.background = '#00c853';
                
                cartCount++;
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.style.background = '';
                }, 1500);
            });
        });

        // Product card click
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', (e) => {
                if (!e.target.closest('.add-to-cart-btn') && !e.target.closest('.quick-view-btn')) {
                    console.log('Navigate to product details');
                }
            });
        });

        // Quick view buttons
        document.querySelectorAll('.quick-view-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                console.log('Open quick view modal');
            });
        });

        // Category cards - scroll to products and filter
        document.querySelectorAll('.category-card').forEach((card, index) => {
            card.addEventListener('click', () => {
                const categories = ['mms', 'cds', 'dmso', 'zeolite', 'zafarane'];
                const categoryName = categories[index];
                
                // Find and click the corresponding filter button
                const filterButton = document.querySelector(`.filter-btn[data-category="${categoryName}"]`);
                if (filterButton) {
                    // Scroll to products section
                    document.querySelector('.products-grid').scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                    
                    // Trigger filter after scroll
                    setTimeout(() => {
                        filterButton.click();
                    }, 500);
                }
            });
        });

        // Category Filter Functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const productCards = document.querySelectorAll('.product-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                button.classList.add('active');
                
                // Get selected category
                const category = button.getAttribute('data-category');
                
                // Filter products
                productCards.forEach(card => {
                    if (category === 'all') {
                        card.style.display = 'block';
                        // Trigger animation
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 10);
                    } else {
                        if (card.getAttribute('data-category') === category) {
                            card.style.display = 'block';
                            setTimeout(() => {
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0)';
                            }, 10);
                        } else {
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(30px)';
                            setTimeout(() => {
                                card.style.display = 'none';
                            }, 300);
                        }
                    }
                });
            });
        });

        // Smooth animations on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Apply animations to elements
        document.querySelectorAll('.product-card, .category-card, .testimonial-card, .feature-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
