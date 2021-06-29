document.getElementById('searchField').addEventListener('input', (event) => {
    const query = event.target.value;

    const list = document.getElementById('autocomplete');

    if (query !== '') {
        fetch(`/categories/autocomplete?q=${query}`, { method: 'GET' })

            .then((response) => response.json())

            .then((categories) => {
                list.innerHTML = '';

                categories.forEach((category) => {
                    const link = document.createElement('a');
                    link.href = `/categories/${category.id}`;
                    link.innerHTML = category.title;

                    const li = document.createElement('li');
                    li.appendChild(link);

                    list.appendChild(li);
                });
            });
    } else {
        list.innerHTML = '';
    }
});
