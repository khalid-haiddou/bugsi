        // Toggle Password Visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.textContent = type === 'password' ? '👁️' : '🙈';
        });

        // Form Validation
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const loginBtn = document.getElementById('loginBtn');

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validatePassword(password) {
            return password.length >= 6;
        }

        emailInput.addEventListener('blur', () => {
            if (!validateEmail(emailInput.value)) {
                emailInput.classList.add('error');
                emailError.classList.add('show');
            } else {
                emailInput.classList.remove('error');
                emailError.classList.remove('show');
            }
        });

        passwordInput.addEventListener('blur', () => {
            if (!validatePassword(passwordInput.value)) {
                passwordInput.classList.add('error');
                passwordError.classList.add('show');
            } else {
                passwordInput.classList.remove('error');
                passwordError.classList.remove('show');
            }
        });

        emailInput.addEventListener('input', () => {
            if (emailInput.classList.contains('error')) {
                emailInput.classList.remove('error');
                emailError.classList.remove('show');
            }
        });

        passwordInput.addEventListener('input', () => {
            if (passwordInput.classList.contains('error')) {
                passwordInput.classList.remove('error');
                passwordError.classList.remove('show');
            }
        });

        // Form Submit
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const email = emailInput.value;
            const password = passwordInput.value;
            let isValid = true;

            // Validate email
            if (!validateEmail(email)) {
                emailInput.classList.add('error');
                emailError.classList.add('show');
                isValid = false;
            }

            // Validate password
            if (!validatePassword(password)) {
                passwordInput.classList.add('error');
                passwordError.classList.add('show');
                isValid = false;
            }

            if (isValid) {
                // Show loading state
                loginBtn.classList.add('loading');
                loginBtn.textContent = 'جاري تسجيل الدخول...';

                // Simulate API call
                setTimeout(() => {
                    console.log('Login successful!', { email, password });
                    loginBtn.textContent = '✓ تم التسجيل بنجاح';
                    loginBtn.style.background = '#00c853';

                    // Redirect after 1 second
                    setTimeout(() => {
                        // window.location.href = '/dashboard';
                        alert('تم تسجيل الدخول بنجاح!');
                        loginBtn.classList.remove('loading');
                        loginBtn.textContent = 'تسجيل الدخول';
                        loginBtn.style.background = '';
                        loginForm.reset();
                    }, 1000);
                }, 1500);
            }
        });

        // Social Login
        document.getElementById('googleLogin').addEventListener('click', () => {
            console.log('Google login clicked');
            alert('تسجيل الدخول عبر Google');
        });

        document.getElementById('facebookLogin').addEventListener('click', () => {
            console.log('Facebook login clicked');
            alert('تسجيل الدخول عبر Facebook');
        });

        // Forgot Password
        document.querySelector('.forgot-password').addEventListener('click', (e) => {
            e.preventDefault();
            alert('سيتم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني');
        });
