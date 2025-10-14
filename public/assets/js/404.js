        // Log 404 error for analytics
        console.log('404 Page - URL:', window.location.href);

        // Optional: Send 404 to analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', 'page_view', {
                page_title: '404 - Page Not Found',
                page_path: window.location.pathname
            });
        }

        // Auto-focus search input
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.search-input');
            if (searchInput) {
                searchInput.focus();
            }
        });
