export default function infoFadeOut() {
    const statusField = document.getElementById('status');
    const errorField = document.getElementById('error');

    function fadeOut(element) {
        if (!element) return;

        setTimeout(() => {
            element.style.transition = 'opacity 1s ease';
            element.style.opacity = '0';

            setTimeout(() => {
                element.style.display = 'none';
            }, 1000);
        }, 10000);
    }

    if (statusField) fadeOut(statusField);
    if (errorField) fadeOut(errorField);
}
