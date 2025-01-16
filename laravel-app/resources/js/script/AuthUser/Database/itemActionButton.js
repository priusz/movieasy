import detailsButton from "./detailsButton.js";

export default function itemActionButton() {

    const actionButtons = document.querySelectorAll('.item__action__button:not([data-listened])');

    actionButtons.forEach(action => {

        action.setAttribute('data-listened', 'true');

        action.addEventListener('click', (event) => {

            event.preventDefault();

            const target = action.getAttribute('data-action-id');
            const itemId = action.getAttribute('data-id');

            if (target === 'item-my-list') fetchMyList(itemId);
            else if (target === 'item-favorite') fetchFavorite(itemId);
            else if (target === 'item-watchlist') fetchWatchlist(itemId);

        });
    });
}

function fetchMyList(itemId) {

    fetch(`/update/myList/${itemId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById(`${itemId}`).outerHTML = html;
            attachDynamicListeners();
        })
        .catch(error => console.error('Error update the collection: ', error));

}

function fetchFavorite(itemId) {

}

function fetchWatchlist(itemId) {

}

function attachDynamicListeners() {
    detailsButton();
    itemActionButton();
}
