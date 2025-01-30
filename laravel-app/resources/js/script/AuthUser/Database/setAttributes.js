export default function setAttributes() {
    setTimeout(() => {
        const typeElement = document.getElementById('modal-data-type');
        let type = typeElement ? typeElement.getAttribute('data-value') : '';

        let season = '0';
        let episode = '0';

        if (type === "season" || type === "episode") {
            const seasonElement = document.getElementById('modal-data-season');
            const episodeElement = document.getElementById('modal-data-episode');

            season = seasonElement ? seasonElement.getAttribute('data-value') : '0';
            episode = episodeElement ? episodeElement.getAttribute('data-value') : '0';
        }

        const buttons = document.querySelectorAll('.modal__action__button');
        buttons.forEach(button => {
            button.setAttribute('data-season', season);
            button.setAttribute('data-episode', episode);
        });

    }, 50);
}
