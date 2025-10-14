  
        // Simulate order number from URL
        const urlParams = new URLSearchParams(window.location.search);
        const orderId = urlParams.get('order_id') || '12345';
        
        // Update order number if different
        document.querySelectorAll('.order-number').forEach(el => {
            el.textContent = `رقم الطلب: #${orderId}`;
        });

        // Optional: Confetti effect on page load
        console.log('Order confirmed successfully! Order ID:', orderId);
 