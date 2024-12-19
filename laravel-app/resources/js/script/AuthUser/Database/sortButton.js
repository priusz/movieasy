export default function sortButton() {
    const sortButton = document.getElementById('sort-button');
    if (sortButton) {
        sortButton.addEventListener('change', function (event) {
            event.preventDefault();
            document.getElementById('sort-form').submit();
        });
    }
}
