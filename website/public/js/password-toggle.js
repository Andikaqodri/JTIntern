document.querySelectorAll('[data-password-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const input = document.getElementById(button.dataset.passwordToggle);
        const icon = button.querySelector('i');

        if (!input || !icon) {
            return;
        }

        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        input.classList.toggle('password-visible', isHidden);
        icon.classList.toggle('bi-eye', !isHidden);
        icon.classList.toggle('bi-eye-slash', isHidden);
        button.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Lihat password');
    });
});
