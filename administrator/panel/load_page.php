<script>
    // Función para obtener el valor de un parámetro de la URL
    function getUrlParameter(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Obtener el valor del parámetro 'page' de la URL
    const page = getUrlParameter('page');

    // Si 'page' existe en la URL, cargar el contenido automáticamente
    if (page) {
        fetch(page)
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo cargar el contenido.');
                }
                return response.text();
            })
            .then(html => {
                document.getElementById('panel-content').innerHTML = html;
            })
            .catch(error => {
                document.getElementById('panel-content').innerHTML = '<p>Error al cargar el contenido.</p>';
                console.error(error);
            });
    }

    // Evento de clic en los enlaces del menú
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const page = link.getAttribute('data-page');
            window.history.pushState({}, '', '?page=' + page); // Actualiza la URL sin recargar
            fetch(page)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('No se pudo cargar el contenido.');
                    }
                    return response.text();
                })
                .then(html => {
                    document.getElementById('panel-content').innerHTML = html;
                })
                .catch(error => {
                    document.getElementById('panel-content').innerHTML = '<p>Error al cargar el contenido.</p>';
                    console.error(error);
                });
        });
    });
</script>
