document.addEventListener('DOMContentLoaded', function () {

    //logout confirm
    const logoutButton = document.getElementById('logout-button');
    logoutButton.addEventListener('click', function (event) {
        event.preventDefault();
        const logoutUrl = this.getAttribute('data-url');
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = logoutUrl;
        }
    })
})

