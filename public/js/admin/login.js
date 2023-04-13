// Show & Hide Password
function show_hide_password() {
    const eye = document.querySelector('#eye')
    const passwordInput = document.getElementById('password')

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text'
        eye.classList.remove('fa-eye-slash')
        eye.classList.add('fa-eye')
    } else {
        passwordInput.type = 'password'
        eye.classList.remove('fa-eye')
        eye.classList.add('fa-eye-slash')
    }
}
