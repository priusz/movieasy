import sortButton from "./sortButton.js";
import posterButton from "./posterButton.js";
import detailsButton from "./detailsButton.js";
import itemActionButton from "./itemActionButton.js";

export default function paginationLinks() {
    const pageLinks = document.querySelectorAll('.page-link');
    const resultsContainer = document.querySelector('#results-container');

    pageLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();

            const targetPage = link.dataset.page;

            fetch('/update-page', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ currentPage: targetPage }),
            })
                .then(response => response.text())
                .then(html => {
                    resultsContainer.outerHTML = html;
                    attachDynamicListeners();
                })
                .catch(error => console.error('Error:', error));
        });
    });
}

function attachDynamicListeners() {
    posterButton();
    sortButton();
    paginationLinks();
    detailsButton();
    itemActionButton();
}
