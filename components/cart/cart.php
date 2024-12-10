<?php

include "../../includes/paths.php";
include $bp."head.php";
include $bp."user-validation.php";
include $bp."dbconnect.php";

$query = "SELECT * FROM departments";
$dataset = mysqli_query($Conn,$query);

mysqli_close($Conn);

?>

<body>
    <?php
        include $bp."mobile-detector.php";
        include $detect->isTablet() || $detect->isMobile() ? $bp . "nav2.php" : $bp . "nav.php";
        include $bp."contact.php";
        include "../../dev/dev.php";
    ?>

    <div class="cart-container">

        <div style="height: 100px;"></div>

        <div class="cart-elements"></div>
        <div style="height: 50px;"></div>
        
        <div class="cart-button">
            Confirmar
        </div>

    </div>
    
</body>
</html>

<script>
    // Obtener el arreglo de productos del sessionStorage
    const cartArray = JSON.parse(sessionStorage.getItem("carrito"));

    // Seleccionar el contenedor donde se mostrarán los productos
    const cartProductsContainer = document.querySelector('.cart-elements');

    // Verificar si hay productos en el sessionStorage
    if (cartArray && cartArray.length > 0) {
        // Iterar sobre el arreglo de productos y crear elementos HTML
        cartArray.forEach(elemento => {
            const cartProducts = document.createElement('div');
            cartProducts.className = 'cart-products';

            // Crear y agregar la imagen
            const imageDiv = document.createElement('div');
            imageDiv.className = 'cart-image';
            const img = document.createElement('img');
            img.style.height = '130px';
            img.style.width = '130px';
            img.src = `../../images/departments/carnes_procesadas/${elemento.productImage}`;
            imageDiv.appendChild(img);
            cartProducts.appendChild(imageDiv);
            

            // Crear y agregar la descripción
            const descriptionDiv = document.createElement('div');
            descriptionDiv.className = 'cart-description';
            descriptionDiv.textContent = elemento.productDescription;
            cartProducts.appendChild(descriptionDiv);

            // Crear y agregar el precio
            const priceDiv = document.createElement('div');
            priceDiv.className = 'cart-price';
            priceDiv.textContent = '$ ' + elemento.productPrice;
            cartProducts.appendChild(priceDiv);

            // Crear y agregar el precio
            const quantityDiv = document.createElement('div');
            quantityDiv.className = 'cart-quantity';
            quantityDiv.textContent = elemento.productQuantity;
            cartProducts.appendChild(quantityDiv);

            // Crear y agregar el precio completo
            const fullPriceDiv = document.createElement('div');
            fullPriceDiv.className = 'cart-full-price';
            fullPriceDiv.textContent = '$ ' + elemento.productPrice*elemento.productQuantity + '.00';
            cartProducts.appendChild(fullPriceDiv);

            // separador
            const separatorDiv = document.createElement('div');
            separatorDiv.className = 'cart-separator';
            separatorDiv.style.height = '1px';
            separatorDiv.style.backgroundColor = '#ddd';
            separatorDiv.style.marginLeft = '40px';
            separatorDiv.style.marginRight = '40px';
            separatorDiv.style.marginTop = '10px';
            separatorDiv.style.marginBottom = '10px';

            // Agregar el elemento del carrito al contenedor
            cartProductsContainer.appendChild(cartProducts);
            cartProductsContainer.appendChild(separatorDiv);

            
        });

        const valueDiv = document.createElement('div');
        valueDiv.className = 'cart-value';
        cartProductsContainer.appendChild(valueDiv);

    } else {
        cartProductsContainer.innerHTML = '<p>No hay productos en el carrito.</p>';
    }
</script>