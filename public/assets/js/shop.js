        // Intersection Observer for fade-in animations
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

        // View Toggle
        const gridViewBtn = document.getElementById('gridView');
        const listViewBtn = document.getElementById('listView');
        const productsGrid = document.getElementById('productsGrid');

        gridViewBtn.addEventListener('click', () => {
            productsGrid.classList.remove('list-view');
            gridViewBtn.classList.add('active');
            listViewBtn.classList.remove('active');
        });

        listViewBtn.addEventListener('click', () => {
            productsGrid.classList.add('list-view');
            listViewBtn.classList.add('active');
            gridViewBtn.classList.remove('active');
        });

        // Add to Cart
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                const originalText = button.textContent;
                button.textContent = '✓ تمت الإضافة';
                button.style.background = '#00c853';

                setTimeout(() => {
                    button.textContent = originalText;
                    button.style.background = '';
                }, 1500);
            });
        });

        // Product Card Click
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            card.addEventListener('click', (e) => {
                if (!e.target.closest('.add-to-cart-btn') && !e.target.closest('.quick-view-btn')) {
                    console.log('Navigate to product details');
                    // window.location.href = '/product/slug';
                }
            });
        });

        // Quick View
        document.querySelectorAll('.quick-view-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                console.log('Open quick view modal');
            });
        });

        // Pagination
        document.querySelectorAll('.pagination-btn:not([disabled])').forEach(btn => {
            btn.addEventListener('click', () => {
                if (!btn.textContent.includes('السابق') && !btn.textContent.includes('التالي')) {
                    document.querySelectorAll('.pagination-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            });
        });

        // Sort functionality
        const sortSelect = document.getElementById('sortSelect');
        sortSelect.addEventListener('change', (e) => {
            const sortValue = e.target.value;
            const cards = Array.from(document.querySelectorAll('.product-card'));
            
            cards.sort((a, b) => {
                const priceA = parseInt(a.dataset.price);
                const priceB = parseInt(b.dataset.price);
                const nameA = a.querySelector('h3').textContent;
                const nameB = b.querySelector('h3').textContent;
                
                switch(sortValue) {
                    case 'price-low':
                        return priceA - priceB;
                    case 'price-high':
                        return priceB - priceA;
                    case 'name':
                        return nameA.localeCompare(nameB, 'ar');
                    default:
                        return 0;
                }
            });
            
            cards.forEach(card => productsGrid.appendChild(card));
        });
