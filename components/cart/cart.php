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

    <div class="cart-alert-shadow">
    </div>
    <div class="cart-alert" id="cart-alert">
        <div class="cart-alert-text" id="cart-alert-text">
            <div class="cart-alert-text-content" id="cart-alert-text-content">
                deseas quitar este elemento de tu carrito?
            </div>
        </div>
        <div class="cart-button1" id="cart-button1" onclick="alert_hide()">
            <div class="cart-alert-button-no red " id="cart-alert-button-no">No</div>
        </div>
        <div class="art-button2" id="cart-button2" onclick="delete_product()">
            <div class="cart-alert-button-yes red" id="cart-alert-button-yes">Sí</div>
        </div>
    </div>

    <div class="cart-container">
        
        <div style="margin-top: 100px; margin-bottom: 20px; display: flex; justify-content: center; align-items: center;">
            <img style="height: 100px; width: 150px; filter: brightness(0) saturate(100%) invert(38%) sepia(1%) saturate(1225%) hue-rotate(323deg) brightness(91%) contrast(93%);" src="../../images/logo2.svg" alt="">
        </div>
        <div style="height: 80px; display: flex; justify-content: start; align-items: center; font-size: 25px; "> Productos a pedir:</div>

        <div class="cart-elements"></div>

        <div style="height: 50px;"></div>
        <div style="font-size: 25px; text-align: center; display: flex; align-items: center; justify-content: center;">
            <p style="width: 80%; font-weight: bold; color: #666;">Si deseas recibir esta compra a domicilio inicia sesión o registrate</p>
        </div>
        <div style="height: 50px;"></div>

        <div class="cart-button red">
            Confirmar compra
        </div>
        <div style="height: 150px;"></div>

    </div>
    
</body>
</html>

<script>

let total = 0;
const cartArray = JSON.parse(sessionStorage.getItem("carrito"));
const cartProductsContainer = document.querySelector('.cart-elements');



document.addEventListener('DOMContentLoaded', function() {

    // Verificar si hay productos en el sessionStorage
    if (cartArray && cartArray.length > 0) {


        // Iterar sobre el arreglo de productos y crear elementos HTML
        cartArray.forEach(elemento => {
            
            const [cartProducts,
            imageDiv,
            dataDiv,
            descriptionDiv,
            priceDiv,
            quantityDiv,
            quantityMinusDiv,
            quantityStockDiv,
            quantityPlusDiv,
            deleteDiv,
            fullPriceDiv] = Array(11).fill().map(() => document.createElement('div'));

            cartProducts.className = 'cart-product';

            imageDiv.className = 'cart-image';
            const img = document.createElement('img');
            img.className = 'cart-image-values';
            img.src = `../../images/departments/${elemento.productDepartment}/${elemento.productImage}`;
            imageDiv.appendChild(img);

            dataDiv.className = 'cart-data';
            
            descriptionDiv.className = 'cart-description';
            descriptionDiv.textContent = elemento.productDescription;
            dataDiv.appendChild(descriptionDiv);

            priceDiv.className = 'cart-price';
            priceDiv.textContent =   '$ ' + elemento.productPrice;
            dataDiv.appendChild(priceDiv);

            quantityDiv.className = 'cart-quantity';

            quantityMinusDiv.className = 'cart-quantity-minus red';
            quantityMinusDiv.id = 'cart-quantity-minus';
            quantityMinusDiv.setAttribute('data-id', elemento.productId);

            if (elemento.productQuantity == 1) {
                
                quantityMinusDiv.setAttribute('onclick', 'alert(' + elemento.productId + ')');
                
            } else {
                
                quantityMinusDiv.setAttribute('onclick', 'remove(' + elemento.productId + ',\''+ elemento.productPrice +'\',1)');
            }

            const quantityMinusImgDiv = document.createElement('img');
            quantityMinusImgDiv.src = '../../images/minus.svg';
            quantityMinusImgDiv.id = 'cart-quantity-minus-img';
            quantityMinusDiv.appendChild(quantityMinusImgDiv);

            quantityStockDiv.className = 'cart-quantity-stock';
            quantityStockDiv.id = 'cantidad' + elemento.productId;
            quantityStockDiv.textContent = elemento.productQuantity;

            quantityPlusDiv.className = 'cart-quantity-plus red';
            quantityPlusDiv.setAttribute('onclick', 'add(' + elemento.productId + ',\'' + elemento.productDescription + '\',\'' + elemento.productDepartment + '\',\'' + elemento.productPrice + '\',\'' + elemento.productImage + '\',1)');
            
            const quantityPlusImgDiv = document.createElement('img');
            quantityPlusImgDiv.src = '../../images/plus.svg';
            quantityPlusDiv.appendChild(quantityPlusImgDiv);
            
            deleteDiv.className = 'cart-delete';
            deleteDiv.setAttribute('onclick', 'alert(' + elemento.productId + ')');
            deleteDiv.textContent = 'Eliminar';
            deleteDiv.id = 'cart-delete';
            deleteDiv.setAttribute('data-id', elemento.productId);

            fullPriceDiv.className = 'cart-full-price';
            fullPriceDiv.id = 'full' + elemento.productId;
            fullPriceDiv.textContent = '$ ' + elemento.productPrice*elemento.productQuantity + '.00';

            [quantityMinusDiv,quantityStockDiv,quantityPlusDiv].forEach(element => quantityDiv.appendChild(element));
            [imageDiv,dataDiv,quantityDiv,deleteDiv,fullPriceDiv].forEach(element => cartProducts.appendChild(element));

            // separador
            const separatorDiv = document.createElement('div');
            separatorDiv.className = 'cart-separator';
            separatorDiv.style.height = '1px';
            separatorDiv.style.backgroundColor = '#ddd';
            separatorDiv.style.marginLeft = '10px';
            separatorDiv.style.marginRight = '10px';
            separatorDiv.style.marginTop = '10px';
            separatorDiv.style.marginBottom = '10px';

            cartProductsContainer.appendChild(cartProducts);
            cartProductsContainer.appendChild(separatorDiv);

            total += elemento.productPrice*elemento.productQuantity;
        });

    } else {
        cartProductsContainer.innerHTML = '<p>No hay productos en el carrito.</p>';
    }

    const valueDiv = document.createElement('div');
    valueDiv.className = 'cart-value';
    cartProductsContainer.appendChild(valueDiv);
    
    const valueStringDiv = document.createElement('div');
    valueStringDiv.className = 'cart-value-string';
    valueStringDiv.textContent = 'Total:';
    valueStringDiv.style.fontSize = '20px';
    valueDiv.appendChild(valueStringDiv);
    const valueNumberDiv = document.createElement('div');
    valueNumberDiv.className = 'cart-value-number';
    valueNumberDiv.textContent = '$ ' + total + '.00';
    valueDiv.appendChild(valueNumberDiv);
});

function alert(productId) {

    const shadow = document.querySelector('.cart-alert-shadow');
    const alert = document.querySelector('.cart-alert');

    sessionStorage.setItem('id-element', productId);
    
    shadow.classList.add('hidden-shadow');
    alert.classList.add('hidden-alert');
}

window.addEventListener('scroll', alert_hide);
window.addEventListener('click', function () {

    if (event.target.id !== 'cart-alert'
            && event.target.id !== 'cart-alert-text'
            && event.target.id !== 'cart-alert-text-content'
            && event.target.id !== 'cart-delete'
            && event.target.id !== 'cart-alert-button-yes'
            && event.target.id !== 'cart-quantity-minus'
            && event.target.id !== 'cart-quantity-minus-img') {
        
        alert_hide();
    }
});

function alert_hide() {

    const shadow = document.querySelector('.cart-alert-shadow');
    const alert = document.querySelector('.cart-alert');
    
    sessionStorage.removeItem('id-element');

    shadow.classList.remove('hidden-shadow');
    alert.classList.remove('hidden-alert');
}

function delete_product() {

    // Recuperar el ID del producto a eliminar desde sessionStorage
    const elementId = sessionStorage.getItem('id-element');

    // Recuperar el carrito desde sessionStorage
    const carrito = JSON.parse(sessionStorage.getItem('carrito')); 

    if (carrito && carrito.length > 0) {
        let productFound = false;

        for (let i = 0; i < carrito.length; i++) {
            if (carrito[i].productId == elementId) {
                console.log(`Producto encontrado: ${carrito[i].productId}`);

                // Eliminar el producto del carrito
                carrito.splice(i, 1);
                productFound = true;

                // Actualizar el carrito en sessionStorage
                sessionStorage.setItem('carrito', JSON.stringify(carrito));

                // Recargar la página después de actualizar el carrito
                location.reload();
                break;
            }
        }

        if (!productFound) {
            console.log("Producto no encontrado en el carrito.");
        }
    } else {
        console.log("El carrito está vacío o no existe.");
    }
}



</script>
