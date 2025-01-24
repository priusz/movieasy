import detailsButton from "./detailsButton.js";

export default function itemActionButton() {

    const actionButtons = document.querySelectorAll('.item__action__button:not([data-listened])');

    actionButtons.forEach(action => {

        action.setAttribute('data-listened', 'true');

        action.addEventListener('click', (event) => {

            event.preventDefault();

            const target = action.getAttribute('data-action-name');
            let itemId = action.getAttribute('data-id');
            itemId = itemId.split('-').pop();
            const season = action.getAttribute('data-season') ?? 0;
            const episode = action.getAttribute('data-episode') ?? 0;

            if (target === 'item-my-list' || target === 'item-favorite' || 'item-watchlist') fetchItemUpdate(target, itemId, season, episode);
            else if (target === 'modal-my-list' || target === 'modal-favorite' || target === 'modal-watchlist') fetchModalUpdate(target, itemId, season, episode); //item fetch???

        });
    });
}

function fetchItemUpdate(target, itemId, season, episode) {

    fetch(`/update/item/${target}/${itemId}/${season}/${episode}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById(`item-${itemId}`).outerHTML = html;
            attachDynamicListeners();
        })
        .catch(error => console.error('Error update the collection: ', error));

}

function fetchModalUpdate(itemId) {

    fetch(`/update/modal/${target}/${itemId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById(`${itemId}`).outerHTML = html;
            attachDynamicListeners();
        })
        .catch(error => console.error('Error update the collection: ', error));

}

function attachDynamicListeners() {
    detailsButton();
    itemActionButton();
}
