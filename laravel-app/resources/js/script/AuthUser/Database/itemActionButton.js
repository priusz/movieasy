import detailsButton from "./detailsButton.js";

export default function itemActionButton() {

    const actionButtons = document.querySelectorAll('.item__action__button:not([data-listened])');

    actionButtons.forEach(action => {

        action.setAttribute('data-listened', 'true');

        action.addEventListener('click', (event) => {

            event.preventDefault();

            const target = action.getAttribute('data-action-name');
            const itemId = action.getAttribute('data-id');
            const season = action.getAttribute('data-season');
            const episode = action.getAttribute('data-episode');

            if (target === 'item-my-list' || target === 'item-favorite' || 'item-watchlist') fetchItemUpdate(target, itemId);
            else if (target === 'modal-my-list' || target === 'modal-favorite' || target === 'modal-watchlist') fetchModalUpdate(target, itemId, season, episode); //item fetch???

        });
    });
}

function fetchItemUpdate(target, itemId) {

    fetch(`/update/item/${target}/${itemId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById(`${itemId}`).outerHTML = html;
            attachDynamicListeners();
        })
        .catch(error => console.error('Error update the collection: ', error));

}

function fetchModalUpdate(itemId) {

}


function attachDynamicListeners() {
    detailsButton();
    itemActionButton();
}
