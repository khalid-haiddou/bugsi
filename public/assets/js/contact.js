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

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Form submission handling
        const contactForm = document.getElementById('contactForm');
        const formMessage = document.getElementById('formMessage');

        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = contactForm.querySelector('.submit-btn');
            const originalText = submitBtn.textContent;

            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.textContent = 'جاري الإرسال...';

            // Get form data
            const formData = new FormData(contactForm);
            const data = Object.fromEntries(formData);

            // Simulate form submission (replace with actual API call in Laravel)
            try {
                // Simulate API delay
                await new Promise(resolve => setTimeout(resolve, 1500));

                // Show success message
                formMessage.className = 'form-message success';
                formMessage.textContent = '✓ تم إرسال رسالتك بنجاح! سنرد عليك قريباً.';
                formMessage.style.display = 'block';

                // Reset form
                contactForm.reset();

                // Hide message after 5 seconds
                setTimeout(() => {
                    formMessage.style.display = 'none';
                }, 5000);

            } catch (error) {
                // Show error message
                formMessage.className = 'form-message error';
                formMessage.textContent = '✗ حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.';
                formMessage.style.display = 'block';
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });

        // Form validation
        const inputs = contactForm.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                if (input.hasAttribute('required') && !input.value.trim()) {
                    input.style.borderColor = 'var(--error)';
                } else {
                    input.style.borderColor = '#e0e0e0';
                }
            });

            input.addEventListener('focus', () => {
                input.style.borderColor = 'var(--primary-color)';
            });
        });

        // Email validation
        const emailInput = document.getElementById('email');
        emailInput.addEventListener('blur', () => {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailInput.value && !emailRegex.test(emailInput.value)) {
                emailInput.style.borderColor = 'var(--error)';
            }
        });

        // Phone number formatting (optional)
        const phoneInput = document.getElementById('phone');
        phoneInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (!value.startsWith('212')) {
                    value = '212' + value;
                }
            }
            e.target.value = value ? '+' + value : '';
        });
