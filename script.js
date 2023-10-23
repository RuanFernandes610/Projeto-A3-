const passwordInput = document.querySelector('.login-input.password')
const passwordEye = document.querySelector('.login-password-eye')

passwordEye.addEventListener('click', function togglePasswordVisibility() {
    if(passwordInput.type === 'text'){
        passwordInput.type = 'password'
        passwordEye.classList.toggle('active')
    } else {
        passwordInput.type = 'text'
        passwordEye.classList.toggle('active')
    }

        console.log (passwordEye.classList)
})