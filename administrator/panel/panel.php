<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPA Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }
        .panel-container {
            display: flex;
            width: 100%;
        }
        .panel-sidenav {
            background-color: #2c3e50;
            color: white;
            width: 200px;
            padding: 20px;
            box-sizing: border-box;
        }
        .panel-sidenav a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }
        .menu-link {
            cursor: pointer;
        }
        .panel-contnet {
            flex-grow: 1;
            padding: 20px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<div class="panel-container">
    <div class="panel-sidenav">
        <a><h1>PANEL</h1></a>
        <br>
        <a class="menu-link" data-page="../consultar/consultar.php?page=consultar">CONSULTAR</a>
        <br>
        <a class="menu-link" data-page="../insertar/insertar.php?page=insertar">INSERTAR</a>
        <br>
        <a class="menu-link" data-page="../modificar/modificar.php?page=modificar">MODIFICAR</a>
    </div>

    <div class="panel-contnet" id="panel-content">
        <p>Por favor, seleccione una opción en el menú.</p>
    </div>
</div>

<script>
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const page = link.getAttribute('data-page');
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
</body>
</html>
