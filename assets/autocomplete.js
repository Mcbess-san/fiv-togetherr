document.getElementById('searchField').addEventListener('input', function(event) {
    let query = event.target.value;

    let list = document.getElementById('autocomplete');

    if (query !== '') {
        fetch('/categories/autocomplete?q=' + query, {method: 'GET'})

            .then(response => response.json())

            .then(categories => {
                list.innerHTML = '';

                categories.forEach(category => {
                    let link = document.createElement('a');
                    link.href = '/categories/' + category.id;
                    link.innerHTML = category.title;

                    let li = document.createElement('li');
                    li.appendChild(link);

                    list.appendChild(li);
                });
            })
        ;
    } else {
        list.innerHTML = '';
    }
});