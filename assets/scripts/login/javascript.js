// change password visibility
let eyeBtn = document.getElementById("eye");
eyeBtn.addEventListener('click', () => {
    let inputField = document.getElementById("userPassword");
    if (inputField.type == 'password') {
        inputField.type = 'text';
        eye.src = '../assets/images/login/eye-solid.svg';
    } else {
        inputField.type = 'password';
        eye.src = '../assets/images/login/eye-slash-solid.svg';
    }
})

// email validation
let enterEmail = document.getElementById('userEmail');
enterEmail.addEventListener('input', () => {
    let submitBtn = document.querySelector('form button');
    let errorMsg = document.querySelector('.errorMsg');

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    errorMsg.innerHTML = '';

    if (emailRegex.test(enterEmail.value)) {
        submitBtn.disabled = false;
        errorMsg.innerHTML = '';
    } else {
        submitBtn.disabled = true;
        errorMsg.innerHTML = `<p>Please enter a valid email address.</p>`;
    }
})