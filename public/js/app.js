document.addEventListener('DOMContentLoaded', function () {
    var el = document.getElementById('categories-list');
    var reorderUrl = el.dataset.reorderUrl; // Acceder a la URL del atributo de datos
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var sortable = Sortable.create(el, {
        handle: '.accordion-header',
        onEnd: function (evt) {
            var order = Array.from(el.children).map(function (item, index) {
                return { id: item.getAttribute('data-id'), position: index + 1 };
            });

            fetch(reorderUrl, { // Usar la URL obtenida del atributo de datos
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ order: order })
            })
            .then(response => response.json())
            .then(data => {
                // ...manejo de la respuesta...
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    });
});
