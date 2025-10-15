        // Sticky header effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Toggle search overlay
        function toggleSearch() {
            const overlay = document.getElementById('searchOverlay');
            overlay.classList.toggle('active');
            if (overlay.classList.contains('active')) {
                document.querySelector('.search-input').focus();
            }
        }

        // Close search on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.getElementById('searchOverlay').classList.remove('active');
                document.getElementById('mobileNav').classList.remove('active');
                document.querySelector('.mobile-menu-toggle').classList.remove('active');
            }
        });

        // Toggle mobile menu
        function toggleMobileMenu() {
            const mobileNav = document.getElementById('mobileNav');
            const toggle = document.querySelector('.mobile-menu-toggle');
            mobileNav.classList.toggle('active');
            toggle.classList.toggle('active');
        }

        // Close search overlay on click outside
        document.getElementById('searchOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                toggleSearch();
            }
        });

        // Update cart badge from cart manager
        function updateCartBadge(count) {
            const badge = document.querySelector('.cart-badge');
            if (badge) {
                badge.textContent = count;
                badge.style.display = count > 0 ? 'block' : 'none';
            }
        }

        // Initialize cart badge on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (window.cartManager) {
                window.cartManager.updateCartBadge();
            }
        });

        // Listen for cart updates
        window.addEventListener('cartUpdated', function() {
            if (window.cartManager) {
                window.cartManager.updateCartBadge();
            }
        });
