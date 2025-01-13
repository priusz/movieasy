export default function detailsButton() {
    document.querySelectorAll(".detailsButton").forEach(link=> {
        link.addEventListener('click', event => {
            event.preventDefault();
            const imdbID = link.getAttribute("data-id");

            fetch(`/details/${imdbID}`)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#modalBody').innerHTML = html;

                    const modal = document.querySelector('#movieDetailsModal');
                    modal.style.display = 'flex';

                    const closeButton = document.querySelector('.close-button');
                    closeButton.addEventListener('click', () => {
                        modal.style.display = 'none';
                    });
                })
            .catch(error => console.error('Error fetching the details: ', error));
        })
    });

    const modal = document.querySelector('#movieDetailsModal');
    modal.addEventListener('click', event => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}
