// Form Elements
const form = document.getElementById('registerForm');
const fullName = document.getElementById('fullName');
const email = document.getElementById('email');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirmPassword');
const terms = document.getElementById('terms');
const submitBtn = document.getElementById('submitBtn');
const successModal = document.getElementById('successModal');
const continueBtn = document.getElementById('continueBtn');

// Toggle Password Visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const type = password.type === 'password' ? 'text' : 'password';
    password.type = type;
    this.textContent = type === 'password' ? '👁️' : '🙈';
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
    const type = confirmPassword.type === 'password' ? 'text' : 'password';
    confirmPassword.type = type;
    this.textContent = type === 'password' ? '👁️' : '🙈';
});

// Email Validation
email.addEventListener('blur', function() {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const errorMsg = document.getElementById('emailError');
    const successMsg = document.getElementById('emailSuccess');

    if (email.value && !emailRegex.test(email.value)) {
        email.classList.add('error');
        email.classList.remove('success');
        errorMsg.classList.add('show');
        successMsg.classList.remove('show');
    } else if (email.value && emailRegex.test(email.value)) {
        email.classList.remove('error');
        email.classList.add('success');
        errorMsg.classList.remove('show');
        successMsg.classList.add('show');
    }
});

// Password Strength Checker
password.addEventListener('input', function() {
    const value = password.value;
    const strengthFill = document.getElementById('strengthFill');
    const strengthText = document.getElementById('strengthText');

    if (value.length === 0) {
        strengthFill.className = 'strength-fill';
        strengthText.textContent = '';
        return;
    }

    let strength = 0;
    if (value.length >= 8) strength++;
    if (value.match(/[a-z]/) && value.match(/[A-Z]/)) strength++;
    if (value.match(/[0-9]/)) strength++;
    if (value.match(/[^a-zA-Z0-9]/)) strength++;

    strengthFill.classList.remove('weak', 'medium', 'strong');
    strengthText.classList.remove('weak', 'medium', 'strong');

    if (strength <= 1) {
        strengthFill.classList.add('weak');
        strengthText.classList.add('weak');
        strengthText.textContent = 'ضعيفة';
    } else if (strength <= 2) {
        strengthFill.classList.add('medium');
        strengthText.classList.add('medium');
        strengthText.textContent = 'متوسطة';
    } else {
        strengthFill.classList.add('strong');
        strengthText.classList.add('strong');
        strengthText.textContent = 'قوية';
    }
});

// Confirm Password Validation
confirmPassword.addEventListener('input', function() {
    const errorMsg = document.getElementById('confirmPasswordError');
    const successMsg = document.getElementById('confirmPasswordSuccess');

    if (confirmPassword.value && confirmPassword.value !== password.value) {
        confirmPassword.classList.add('error');
        confirmPassword.classList.remove('success');
        errorMsg.classList.add('show');
        successMsg.classList.remove('show');
    } else if (confirmPassword.value && confirmPassword.value === password.value) {
        confirmPassword.classList.remove('error');
        confirmPassword.classList.add('success');
        errorMsg.classList.remove('show');
        successMsg.classList.add('show');
    }
});

// Form Submission - UPDATED TO SEND TO LARAVEL
form.addEventListener('submit', async function(e) {
    e.preventDefault();

    // Validate all fields
    let isValid = true;

    if (!fullName.value.trim()) {
        document.getElementById('nameError').classList.add('show');
        fullName.classList.add('error');
        isValid = false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        document.getElementById('emailError').classList.add('show');
        email.classList.add('error');
        isValid = false;
    }

    if (password.value.length < 8) {
        document.getElementById('passwordError').classList.add('show');
        password.classList.add('error');
        isValid = false;
    }

    if (password.value !== confirmPassword.value) {
        document.getElementById('confirmPasswordError').classList.add('show');
        confirmPassword.classList.add('error');
        isValid = false;
    }

    if (!terms.checked) {
        alert('يرجى الموافقة على الشروط والأحكام');
        isValid = false;
    }

    if (!isValid) return;

    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.textContent = 'جاري الإنشاء...';

    // Get CSRF token
    const csrfToken = document.querySelector('input[name="_token"]').value;

    // Prepare form data
    const formData = new FormData(form);

    try {
        // Send POST request to Laravel
        const response = await fetch('/register', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            // Show success modal
            successModal.classList.add('show');
            
            // Store redirect URL
            continueBtn.dataset.redirect = data.redirect;
        } else {
            // Handle errors
            if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const errorMsg = data.errors[key][0];
                    alert(errorMsg);
                });
            }
        }
    } catch (error) {
        console.error('Error:', error);
        alert('حدث خطأ أثناء إنشاء الحساب. يرجى المحاولة مرة أخرى.');
    } finally {
        // Re-enable button
        submitBtn.disabled = false;
        submitBtn.textContent = 'إنشاء الحساب';
    }
});

// Continue Button - UPDATED TO USE REDIRECT URL
continueBtn.addEventListener('click', function() {
    const redirectUrl = this.dataset.redirect || '/';
    window.location.href = redirectUrl;
});

// Close modal on outside click
successModal.addEventListener('click', function(e) {
    if (e.target === successModal) {
        successModal.classList.remove('show');
    }
});

// Clear error on input
[fullName, email, password, confirmPassword].forEach(input => {
    input.addEventListener('input', function() {
        this.classList.remove('error');
        const errorId = this.id + 'Error';
        const errorMsg = document.getElementById(errorId);
        if (errorMsg) {
            errorMsg.classList.remove('show');
        }
    });
});