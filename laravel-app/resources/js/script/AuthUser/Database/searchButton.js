import detailsButton from "./detailsButton.js";
import itemActionButton from "./itemActionButton.js";

export default function searchButton() {
    const searchButton = document.getElementById('search-button');
    if (searchButton) {
        searchButton.addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById('search-form').submit();
        });

        detailsButton();
        itemActionButton();
    }
}
