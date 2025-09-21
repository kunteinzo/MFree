const root = document.getElementById('content');

fetch('./api.php', {method: 'GET'})
    .then(rp => rp.json())
    .then(rp => {
    	for (let i = 0; i < rp.length; i++) {
        	root.innerHTML = root.innerHTML + "<br>" + rp[i]["titleMm"];
        }
    })
    .catch(err => console.log(err));
