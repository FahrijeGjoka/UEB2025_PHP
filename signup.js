document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('signup-form');
  const passwordError = document.getElementById('password-error');
  const confirmPasswordError = document.getElementById('confirm-password-error');

 
  form.addEventListener('submit', function (e) {
    e.preventDefault(); 

    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');

    let isValid = true;

    passwordError.textContent = '';
    confirmPasswordError.textContent = '';

   
    if (!/^[A-Z]/.test(password.value)) {
      passwordError.textContent = 'Password must start with an uppercase letter.';
      isValid = false;
    }

    
    if (password.value.length < 6) {
      passwordError.textContent = 'Password must be at least 6 characters long.';
      isValid = false;
    }

   
    if (!/[!@#$%^&*(),.?":{}|<>]/.test(password.value)) {
      passwordError.textContent = 'Password must include at least one special character.';
      isValid = false;
    }

  
    if (password.value !== confirmPassword.value) {
      confirmPasswordError.textContent = 'Passwords do not match.';
      isValid = false;
    }

    if (isValid) {
      alert('Form submitted successfully!');
      form.reset(); 
    }
  });

 
  form.addEventListener('reset', function () {

    passwordError.textContent = '';
    confirmPasswordError.textContent = '';

  
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => input.classList.remove('error'));
  });
});
