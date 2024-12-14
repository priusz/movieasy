export default function searchButton() {
    const searchButton = document.getElementById('search-button');
    if (searchButton) {
        searchButton.addEventListener('click', function (event) {
            event.preventDefault();
            document.querySelector('form').submit();
        });
    }
}
