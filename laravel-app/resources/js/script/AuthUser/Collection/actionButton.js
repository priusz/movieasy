export default function actionButton() {

    const actionButtons = document.querySelectorAll('.collection__action__button:not([data-listened])');

    actionButtons.forEach(action => {

        action.setAttribute('data-listened', 'true');

        action.addEventListener('click', (event) => {

            event.preventDefault();

            const target = action.getAttribute('data-action-name');
            const itemId = action.getAttribute('data-id');
            const type = action.getAttribute('data-type');
            const season = action.getAttribute('data-season') ?? 0;
            const episode = action.getAttribute('data-episode') ?? 0;

            handleCollectionAction(target, itemId, type, season, episode);

        });
    });
}

function handleCollectionAction(target, itemId, type, season, episode) {

    fetch(`/collection/update/${target}/${itemId}/${type}/${season}/${episode}`)
        .then(response => response.text())
        .then(html => {
            const results = document.getElementById('filtered-items');
            results.outerHTML = html;

            actionButton();
        })
        .catch(error => console.error('Error update the collection: ', error));

}
