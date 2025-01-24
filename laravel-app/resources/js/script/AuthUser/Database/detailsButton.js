export default function detailsButton() {
    document.querySelectorAll(".detailsButton:not([data-listened])").forEach(link=> {

        link.setAttribute('data-listened', 'true');

        link.addEventListener('click', event => {
            event.preventDefault();
            let imdbID = link.getAttribute("data-id");
            imdbID = imdbID.split('-').pop();
            const season = link.getAttribute("data-season") ?? 0;
            const episode = link.getAttribute("data-episode") ?? 0;

            fetch(`/details/${imdbID}/${season}/${episode}`)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#modalBody').innerHTML = html;

                    detailsButton();

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
