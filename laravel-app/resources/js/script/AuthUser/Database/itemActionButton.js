import detailsButton from "./detailsButton.js";
import setAttributes from "./setAttributes.js";

export default function itemActionButton() {

    const actionButtons = document.querySelectorAll('.item__action__button:not([data-listened]), .modal__action__button:not([data-listened])');

    actionButtons.forEach(action => {

        action.setAttribute('data-listened', 'true');

        action.addEventListener('click', (event) => {

            event.preventDefault();

            const target = action.getAttribute('data-action-name');
            let itemId = action.getAttribute('data-id');
            itemId = itemId.split('-').pop();
            const season = action.getAttribute('data-season') ?? 0;
            const episode = action.getAttribute('data-episode') ?? 0;

            if (target === 'item-my-list' || target === 'item-favorite' || target === 'item-watchlist') fetchItemUpdate(target, itemId, season, episode);
            else if (target === 'modal-my-list' || target === 'modal-favorite' || target === 'modal-watchlist') {
                handleFetchModalRefreshItem(target, itemId, season, episode)
                    .catch(error => console.error('Error during requests:', error));
            }

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
        .catch(error => console.error('Error update the item: ', error));

}

async function fetchRefreshItem(target, itemId, season, episode) {

    try {

        const type = document.getElementById('modal-data-type').getAttribute('data-value');
        const response = await fetch(`/refresh/item/${target}/${itemId}/${type}/${season}/${episode}`);
        const html = await response.text();

        if (html.trim() === 'noRefresh') {
            return;
        }

        document.getElementById(`item-${itemId}`).outerHTML = html;
        attachDynamicListeners();

    } catch (error) {

        console.error('Error refresh the item: ', error);
    }

}

async function fetchModalUpdate(target, itemId, season, episode) {

    try {

        const response = await fetch(`/update/modal/${target}/${itemId}/${season}/${episode}`);
        const html = await response.text();

        document.getElementById(`modal-${itemId}`).outerHTML = html;

        setAttributes();

        attachDynamicListeners();

    } catch (error) {

        console.error('Error update the modal: ', error)

    }

}

async function handleFetchModalRefreshItem(target, itemId, season, episode) {
    try {

        await fetchModalUpdate(target, itemId, season, episode);
        await fetchRefreshItem(target, itemId, season, episode);

    } catch (error) {

        console.error('Error during requests:', error);
    }
}

function attachDynamicListeners() {
    detailsButton();
    itemActionButton();
}
