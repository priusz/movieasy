import actionButton from "./actionButton.js";

export default function sortCollection() {

    const sortButton = document.getElementById('collection-sort');

    sortButton.addEventListener('click', () => {

        const actualState = sortButton.getAttribute('data-state');

        fetch(`collection/sort/${actualState}`)
            .then(response => response.text())
            .then(html => {

                const filteredItemsField = document.getElementById('filtered-items');
                filteredItemsField.outerHTML = html;

                actualState === 'noSort' || actualState === 'ZA' ?
                    sortButton.setAttribute('data-state', 'AZ')
                    : sortButton.setAttribute('data-state', 'ZA');

                actualState === 'noSort' || actualState === 'ZA' ?
                    sortButton.textContent = 'Sort by title Z -> A'
                    : sortButton.textContent = 'Sort by title A -> Z';

                actionButton();

            })
            .catch(error => console.error('Error sort the collection: ', error));

    })
}
