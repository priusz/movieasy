export default function registerButton() {
    const registerButton = document.getElementById('register-button');
    if (registerButton) {
        registerButton.addEventListener('click', function (event) {
            event.preventDefault();
            document.querySelector('form').submit();
        });
    }
}
