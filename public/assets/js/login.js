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

// Form Submit - UPDATED TO SEND TO LARAVEL
loginForm.addEventListener('submit', async (e) => {
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

    if (!isValid) return;

    // Show loading state
    loginBtn.classList.add('loading');
    loginBtn.disabled = true;
    loginBtn.textContent = 'جاري تسجيل الدخول...';

    // Get CSRF token
    const csrfToken = document.querySelector('input[name="_token"]').value;

    // Prepare form data
    const formData = new FormData(loginForm);

    try {
        // Send POST request to Laravel
        const response = await fetch('/login', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            // Success
            loginBtn.textContent = '✓ تم التسجيل بنجاح';
            loginBtn.style.background = '#00c853';

            // Redirect based on user role
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 1000);
        } else {
            // Login failed
            alert(data.message || 'البريد الإلكتروني أو كلمة المرور غير صحيحة');
            
            // Reset button
            loginBtn.classList.remove('loading');
            loginBtn.disabled = false;
            loginBtn.textContent = 'تسجيل الدخول';
            loginBtn.style.background = '';
        }
    } catch (error) {
        console.error('Error:', error);
        alert('حدث خطأ أثناء تسجيل الدخول. يرجى المحاولة مرة أخرى.');
        
        // Reset button
        loginBtn.classList.remove('loading');
        loginBtn.disabled = false;
        loginBtn.textContent = 'تسجيل الدخول';
        loginBtn.style.background = '';
    }
});

// Forgot Password
document.querySelector('.forgot-password').addEventListener('click', (e) => {
    e.preventDefault();
    alert('سيتم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني');
});