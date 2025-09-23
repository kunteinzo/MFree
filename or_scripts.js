const root = document.getElementById('content');

function initItems(items) {
    for (let i = 0; i < items.length; i++) {
        const title = document.createElement('div');
        title.classList = ['item'];
        title.innerText = items[i]['titleMm'];
        root.append(title);
    }
}

fetch('./api.php/all', {method: 'GET'})
    .then(rp => rp.json())
    .then(rp => initItems(rp))
    .catch(err => console.log(err));
