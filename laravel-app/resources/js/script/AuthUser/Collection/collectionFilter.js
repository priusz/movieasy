export default function collectionFilter() {

    const filterButtons = document.querySelectorAll('.collection-filter');

    filterButtons.forEach(button => {

        let eventType = 'change';

        if (button.tagName.toLowerCase() === 'input') {
            eventType = 'input';
        }

        button.addEventListener(eventType, () => {

            handleFilter();

        })
    } )
}

function handleFilter() {

    const titleInput = document.querySelector('input[data-type="title-search"]');
    const titleValue = titleInput.value.trim() !== '' ? titleInput.value.trim() : 'emptyValue';



    const listTypeInput = document.querySelector('input[name="list-type"]:checked');
    const listTypeValue = listTypeInput ? listTypeInput.value : 'all';

    const itemTypeInput = document.querySelector('input[name="item-type"]:checked');
    const itemTypeValue = itemTypeInput ? itemTypeInput.value : 'all';


    fetch(`collection/filter/${titleValue}/${listTypeValue}/${itemTypeValue}`)
        .then(response => response.text())
        .then(html => {
            const filteredItemsField = document.getElementById('filtered-items');
            filteredItemsField.outerHTML = html;
        })
        .catch(error => console.error('Error filter the collection: ', error));

}
