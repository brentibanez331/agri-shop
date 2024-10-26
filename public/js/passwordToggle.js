document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.querySelector('.toggle-password');

    togglePasswordButton.addEventListener('click', function() {
        const currentType = passwordInput.getAttribute('type');
        const newType = currentType === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', newType);

        const eyeIcon = this.querySelector('svg');
        eyeIcon.classList.toggle('text-gray-200');
        eyeIcon.classList.toggle('text-gray-800');
    });
});


