export default function posterButton() {
    const posterButton = document.getElementById('poster-button');
    if (posterButton) {
        posterButton.addEventListener('change', function (event) {
            event.preventDefault();
            document.getElementById('sort-form').submit();
        });
    }
}
