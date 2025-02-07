export default function collectionFilter() {

    const filterButtons = document.querySelectorAll('.collection-filter');

    filterButtons.forEach(button => {

        let eventType = 'change';

        if (button.tagName.toLowerCase() === 'input') {
            eventType = 'input';
        }

        button.addEventListener(eventType, (event) => {

            const type = button.getAttribute('data-type');

            const value = event.target.value.trim();

            handleFilter(type, value);

        })
    } )
}

function handleFilter(type, value) {

    if (value === '') value = 'emptyValue';

    fetch(`collection/filter/${type}/${value}`)
        .then(response => response.text())
        .then(html => {
            const filteredItemsField = document.getElementById('filtered-items');
            filteredItemsField.outerHTML = html;
        })
        .catch(error => console.error('Error filter the collection: ', error));

}
