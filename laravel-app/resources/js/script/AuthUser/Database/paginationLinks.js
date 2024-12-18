import sortButton from "./sortButton.js";
import posterButton from "./posterButton.js";

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
                body: JSON.stringify({ currentPage: targetPage }), // Az új oldalszám elküldése
            })
                .then(response => response.text())
                .then(html => {
                    resultsContainer.innerHTML = html; // Visszakapott HTML-t kicseréljük
                    attachDynamicListeners();
                })
                .catch(error => console.error('Error:', error));
        });
    });
}

function attachDynamicListeners() {
     // Újraregisztráljuk a lapozási eseményeket

    // Egyéb dinamikus gombok eseményeinek újraregisztrálása
    posterButton();
    sortButton();
    paginationLinks();
    // Ha más dinamikus esemény is szükséges, itt hívjuk őket újra
}
