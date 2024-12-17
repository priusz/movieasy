export default function loginButton() {
    const loginButton = document.getElementById('login-button');
    if (loginButton) {
        loginButton.addEventListener('click', function (event) {
            event.preventDefault();
            document.querySelector('form').submit();
        });
    }
}
