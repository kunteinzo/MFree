const root = document.getElementById('content');

fetch('./api.php', {method: 'GET'})
    .then(rp => rp.text())
    .then(rp => {
        root.innerText = rp;
    })
    .catch(err => console.log(err));
