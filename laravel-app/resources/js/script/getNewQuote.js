export default function getNewQuote() {
    const quoteField = document.getElementById('quote-text');
    if (quoteField) {
        fetch('get-random-quote')
            .then(response => response.json())
            .then(data => {
                document.getElementById('quote-text').textContent = data.quote;
                document.getElementById('quote-saidBy').textContent = data.said_by;
            });
    }
}

