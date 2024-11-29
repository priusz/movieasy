export default function getNewQuote() {
    fetch('get-random-quote')
        .then(response => response.json())
        .then(data => {
            document.getElementById('quote-text').textContent = data.quote;
            document.getElementById('quote-saidBy').textContent = data.said_by;
        });
}

