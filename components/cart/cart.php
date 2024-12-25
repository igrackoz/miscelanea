<?php

$bp = "../../includes/";
include $bp."user-validation.php";
include $bp."head.php";
include $bp."dbconnect.php";
/*
$nombre = isset($nombre) ? $nombre : '';
$apellido = isset($apellido) ? $apellido : '';
$calle = isset($calle) ? $calle : '';
$numero_exterior = isset($numero_exterior) ? $numero_exterior : '';
$telefono = isset($telefono) ? $telefono : '';
$email = isset($email) ? $email : '';
*/
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
                ¿Deseas quitar este elemento de tu carrito?
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
        <div style="margin-top: 80px; margin-bottom: 80px; display: flex; justify-content: center; align-items: center;">
            <img style="height: 100px; width: 150px; filter: brightness(0) saturate(100%) invert(38%) sepia(1%) saturate(1225%) hue-rotate(323deg) brightness(91%) contrast(93%);" src="../../images/logo2.svg" alt="">
        </div>

        <!-- contenedor de elementos del carrito  -->
        <div class="cart-elements"></div>

        <?php if (isset($nombre) && isset($apellido)){ ?>

            <!-- pop up alerta superior de formulario  -->
            <div id="cartalert" style="
                position: fixed;
                font-size: 20px;
                top: -110px;
                background-color: white;
                color: red;
                padding: 20px;
                left: 10px;
                right: 10px;
                border-radius: 5px;
                -webkit-box-shadow: 0px 0px 83px -20px rgba(0,0,0,0.75);
                -moz-box-shadow: 0px 0px 83px -20px rgba(0,0,0,0.75);
                box-shadow: 0px 0px 83px -20px rgba(0,0,0,0.75);
                transition: transform 0.3s ease-in-out;
                z-index: 5000;">
                <div>Completa el formulario!</div>
            </div>

            <!-- botón de pedido  -->
            <div class="cart-button" style="height: 70px;
                color: #fff;
                background-color: gray;
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 10px;
                border-radius: 10px;
                z-index: 10;" onclick="mostrarAlerta()">
                <div style="font-size: 22px;">Solicitar pedido</div>
            </div>

            <!-- botón de mostrar ticket (en proceso)  -->
            <!--<div class="ticket-button" style="height: 70px;
                color: #0D6EFD;
                outline: 2px solid #0D6EFD;
                display: none;
                margin-bottom: 10px;
                justify-content: center;
                align-items: center;
                border-radius: 10px;
                z-index: 10;">
                <div style="font-size: 22px;">Visualizar ticket</div>
            </div>-->

            
            <!-- ticket  -->
            <!--<div id="ticket" style="
                width: 100%;
                height: 0px;
                background-color: white;
                font-family: 'Consolas', monospace;
                overflow: hidden;
                padding: 10px;
                color: gray;
                border-radius: 5px;
                z-index: 9;
                transition: height 0.5s ease;
                
                "><div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                    TICKET DE COMPRA<br>
                    <br>
                    Empresa: Tienda El Rincón Feliz<br>
                    RFC: TRE8901234B56<br>
                    Dirección: Calle Ficticia 123, Colonia Inventada, Localidad: Villa Imaginaria, Estado: Fictilandia<br>
                    Teléfono: 01 800 123 4567<br>
                    Fecha: 21 de diciembre de 2024<br>
                    Hora: 14:35:20<br>
                    Número de ticket: 000123456789<br>
                    Forma de pago: Tarjeta de débito<br>
                    Localidad: Villa Imaginaria<br>
                    </div>
                    PRODUCTOS<br>
                    <br>
                    Camiseta Estampada<br>
                    Cantidad: 2<br>
                    Precio Unitario: $150.00<br>
                    Total: $300.00<br>
                    <br>
                    Pantalón Deportivo<br>
                    Cantidad: 1<br>
                    Precio Unitario: $450.00<br>
                    Total: $450.00<br>
                    <br>
                    Taza Personalizada<br>
                    Cantidad: 3<br>
                    Precio Unitario: $80.00<br>
                    Total: $240.00<br>
                    <br>
                    Mochila de Viaje<br>
                    Cantidad: 1<br>
                    Precio Unitario: $750.00<br>
                    Total: $750.00<br>
                    <br>
                    Calcetines Deportivos<br>
                    Cantidad: 5<br>
                    Precio Unitario: $50.00<br>
                    Total: $250.00<br>
                    <br>
                    Subtotal: $1,990.00v
                    IVA (16%): $318.40<br>
                    Total a Pagar: $2,308.40<br>
                    <br>
                    <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                    Gracias por tu compra.<br>
                    ¡Vuelve pronto!<br><br><br><br><br>
                    </div>
            </div>-->

        <?php } else { ?>

            <!-- botón de inicio de sesión  -->
            <a href="../login/login.php" class="login-button red" style="
                text-decoration: none;
                color: white; display: flex;
                font-size: 25px;
                justify-content: center;
                align-items: center;
                height: 70px; width: 100%;
                border-radius: 10px;
                margin-bottom: 10px;">
                Iniciar Sesión
            </a>

        <?php 

            $nombre = '';
            $apellido = '';
            $calle = '';
            $ciudad = '';
            $estado = '';
            $telefono = '';
            $email = '';
            $direccion = '';
            $numero_exterior = '';
    
        }?>

        <?php include '../../includes/footer-image.php'; ?>

    </div>
</body>
</html>

<script>

window.onload = function() {
    // Verificamos si ya hemos recargado la página antes durante esta sesión
    if (!sessionStorage.getItem("reloaded")) {
        // Si no, marcamos que se ha recargado y recargamos la página
        sessionStorage.setItem("reloaded", "true");
        location.reload();
    } else {
        // Si ya se recargó, eliminamos la marca para la próxima vez
        sessionStorage.removeItem("reloaded");
    }
};

const loginButton = document.querySelector('.login-button');
const cartButton = document.querySelector('.cart-button');
const ticketButton = document.querySelector('.ticket-button');
const alerta = document.getElementById('cartalert');

//  CONDICIONES PARA MOSTRAR ALERTA DE FORMULARIO INCOMPLETO
function mostrarAlerta() {

    const efectivo = document.getElementById('efectivo');
    const tarjeta = document.getElementById('tarjeta');
    const transferencia = document.getElementById('transferencia');

    const efectivoLabel = document.getElementById('efectivoLabel');
    const tarjetaLabel = document.getElementById('tarjetaLabel');
    const transferenciaLabel = document.getElementById('transferenciaLabel');

    if (!(efectivo.checked) && !(tarjeta.checked) && !(transferencia.checked)) {
        
        efectivo.style.borderColor = "red";
        tarjeta.style.borderColor = "red";
        transferencia.style.borderColor = "red";

        efectivoLabel.style.color = 'red';
        tarjetaLabel.style.color = 'red';
        transferenciaLabel.style.color = 'red';
        alertaDespliegue();

    } else if (efectivo.checked){

        var label1 = document.getElementById('label1');
        var label2 = document.getElementById('label2');

        if (!(radio1.checked) && !(radio2.checked)) {

            label1.style.color = "red";
            label2.style.color = "red";
            alertaDespliegue();

        } else if (radio2.checked) {

            const cambioValue = document.getElementById("cambioValue");
            let content = (cambioValue.textContent.substring(2));
            content = parseFloat(content);

            if (isNaN(content)) {
                
                cambioInput.style.borderColor = "#ff8a95";
                cambioInput.focus();
                alertaDespliegue();
            } else {
                shipping();
            }
        } else {
            shipping();
        }
    } else {
        shipping();
    }
}

// ANIMACIÓN DE ALERTA DE FORMULARIO INCOMPLETO
function alertaDespliegue() {
    
    alerta.style.transform = 'translateY(120px)';

    setTimeout(() => {
        alerta.style.transform = 'translateY(-110px)';
    }, 3000);
}
/*
const ticket = document.getElementById("ticket");

ticketButton.addEventListener('click', () => {

    if (ticket.style.height === '0px' || !ticket.style.height) {
        ticket.style.height = '100'; // Altura expandida
    } else {
        ticket.style.height = '0px'; // Colapsar
    }
});*/

// Agregar el evento de clic al botón
//cartButton.addEventListener('click', mostrarAlerta);

function toggleDropdown(button) {

    button.classList.toggle('active');
}

let total = 0;
let totalProducts = 0;
let com = 0;
let first = false;
let desplegado = true;
let cambioVal = 0;

const coolNavbar = document.getElementById('cool-navbar');
const cartRedirect = document.getElementById('cart-redirect');
const cartArray = JSON.parse(sessionStorage.getItem("carrito"));
const mainContainer = document.querySelector('.cart-container');
const cartProductsContainer = document.querySelector('.cart-elements');

function shipping() {


    let method = "";
    const method1 = document.getElementById('efectivo');
    const method2 = document.getElementById('tarjeta');
    const method3 = document.getElementById('transferencia');

    if (method1.checked) {
        method = method1.id;
    }
    if (method2.checked) {
        method = method2.id;
    }
    if (method3.checked) {
        method = method3.id;
    }

    let change = "";
    const change1 = document.getElementById('radio1');
    const change2 = document.getElementById('radio2');

    if (change1.checked) {
        change = "exacto";
    }
    if (change2.checked) {
        change = "otro";
    }

    let coin = "";
    const peso = document.getElementById('peso');
    const dolar = document.getElementById('dolar');

    if (peso.classList.contains('on-currency')) {
        coin = peso.id;
    }
    if (dolar.classList.contains('on-currency')) {
        coin = dolar.id;
    }

    let cash = "";
    const cash1 = document.getElementById('cambioValue');

    cash = cash1.textContent.substring(2);

    const payment = [
        {
            paymentMethod: method,
            paymentChange: change,
            paymentCoin: coin,
            paymentCash: cash

        }
    ];

    sessionStorage.setItem('payment', JSON.stringify(payment));
    const paymentArray = JSON.parse(sessionStorage.getItem("payment"));
    const paymentJSON = JSON.stringify(paymentArray);
    const encodedPayment = encodeURIComponent(paymentJSON);

    const user = [
        {
            userFirstname: "<?= $nombre ?>",
            userLastname: "<?= $apellido ?>",
            userStreet: "<?= $calle ?>",
            userNumExt: "<?= $numero_exterior ?>",
            userPhone: "<?= $telefono ?>",
            userEmail: "<?= $email ?>"

        }
    ];

    sessionStorage.setItem('payment', JSON.stringify(user));
    const userArray = JSON.parse(sessionStorage.getItem("payment"));
    const userJSON = JSON.stringify(userArray);
    const encodedUser = encodeURIComponent(userJSON);

    // ANTES DE LLEGAR A encodedCarrito, eliminar camposinncesarios (porductId, productDepartment, productImage)
    const cartArray = JSON.parse(sessionStorage.getItem("carrito"));
    const filteredCartArray = cartArray.map(item => {
        
        const { productId, productDepartment, productImage, ...filteredItem } = item;
        return filteredItem;
    });
    const carritoJSON = JSON.stringify(filteredCartArray);
    const encodedCarrito = encodeURIComponent(carritoJSON);


    // Paso 4: Redirigir a la página con el parámetro en la URL
    window.location.href = `enviar_pedido.php?products=${encodedCarrito}&payment=${encodedPayment}&user=${encodedUser};`;
}


document.addEventListener('DOMContentLoaded', function() {

    if (cartArray && cartArray.length > 0) { console.log("cart");// Verificar si hay productos en el sessionStorage

        // Al empezar a llenar el formulario se ocultan los productos y aparece un desplegable
        // que muestra solo el número de productos
        const ocultaProductos = document.createElement('div');
        ocultaProductos.className = "ocultaProductos";
        ocultaProductos.id = "ocultaProductos";
        ocultaProductos.style = "padding: 15px 20px 15px 20px; height: 60px; display: flex; justify-content: space-between; align-items: center; border-radius: 10px; border: 1px solid #bbb; background-color: white; color: #777;";
        ocultaProductos.addEventListener("click", () => {

            desplegado = !desplegado;

            const displayValue = desplegado ? "grid" : "none";
            const rotationValue = desplegado ? "rotateZ(180deg)" : "rotateZ(0deg)";

            ocultaIcono.style.transform = rotationValue;

            document.querySelectorAll(".cart-product").forEach((cartProducts) => {
                cartProducts.style.display = displayValue;
            });
            document.querySelectorAll(".product-separator").forEach((separatorDiv) => {
                separatorDiv.style.display = displayValue;
            });
        });
        cartProductsContainer.appendChild(ocultaProductos);

            const ocultaTexto = document.createElement("div");
            ocultaTexto.className = "ocultaTexto";
            ocultaTexto.id = "ocultaTexto";
            ocultaTexto.style.fontSize = "22px";
            ocultaProductos.appendChild(ocultaTexto);

            const ocultaIcono = document.createElement("img");
            ocultaIcono.src = '../../images/down_arrow_black.svg';
            ocultaIcono.className = "ocultaIcono";
            ocultaIcono.style.transform = "rotateZ(180deg)";
            ocultaIcono.id = "ocultaIcono";
            ocultaProductos.appendChild(ocultaIcono);
        //
        // INSERCIÓN DE PRODUCTOS DEL CARRITO
        cartArray.forEach(elemento => {

            totalProducts += parseFloat(elemento.productQuantity);
            
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
            cartProducts.id = 'cart-product';

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
            separatorDiv.className = 'product-separator';
            separatorDiv.style.height = '1px';
            separatorDiv.style.backgroundColor = '#ddd';

            cartProductsContainer.appendChild(cartProducts);
            cartProductsContainer.appendChild(separatorDiv);

            total += elemento.productPrice*elemento.productQuantity;
        });

        ocultaTexto.textContent = totalProducts + " productos";
        
        const user = document.querySelector(".profile-picture");

        if (user) { // USUARIO LOGEADO
            //
            // PAGO INFERIOR AL REQUERIDO
            const noPaymentContainer = document.createElement('div');
            noPaymentContainer.className = "nopayment-container";
            cartProductsContainer.appendChild(noPaymentContainer);

                const LowPaymentAdvice = document.createElement('div');
                LowPaymentAdvice.style = 'display: flex; align-items: start; background-color: #ffa200; color: white; gap: 8px; padding: 15px; margin-bottom: 10px; margin-top: 10px; border-radius: 10px;';
                noPaymentContainer.appendChild(LowPaymentAdvice);

                    const ImageAdvice4 = document.createElement("img");
                    ImageAdvice4.src = '../../images/exclamation-circle.svg';
                    ImageAdvice4.style.marginTop = '5px';
                    LowPaymentAdvice.appendChild(ImageAdvice4);

                    const TextAdvice4 = document.createElement("div");
                    TextAdvice4.color = "white";
                    TextAdvice4.style = "font-size: 18px;";
                    TextAdvice4.textContent = "Para realizar un pedido a domicilio, el total de tu compra debe ser de al menos 50 pesos.";
                    LowPaymentAdvice.appendChild(TextAdvice4);
                //
                // separador
                const separatorDiv3 = document.createElement('div');
                separatorDiv3.className = 'cart-separator';
                separatorDiv3.style.height = '1px';
                separatorDiv3.style.backgroundColor = '#ddd';
                noPaymentContainer.appendChild(separatorDiv3);
            //
            // PAGO ACORDE AL REQUERIDO
            const paymentContainer = document.createElement('div');
            paymentContainer.className = 'payment-container';
            cartProductsContainer.appendChild(paymentContainer);

            if (total >= 50) {
                cartButton.style.display = 'flex';
                noPaymentContainer.style.display = 'none';
                paymentContainer.style.display = 'block';
            } else {
                cartButton.style.display = 'none';
                noPaymentContainer.style.display = 'block';
                paymentContainer.style.display = 'none';
            }

                // MÉTODOS DE PAGO
                const paymentMethodDiv = document.createElement('div');
                paymentMethodDiv.style = 'margin-left: 10px; margin-right: 10px; margin-top: 10px; color: darkgray; font-size: 24px; vertical-align: bottom;';
                paymentMethodDiv.textContent = 'Forma de pago';
                paymentContainer.appendChild(paymentMethodDiv);
                const switches = [

                    { id: "efectivo", label: "Efectivo" },
                    { id: "tarjeta", label: "Tarjeta" },
                    { id: "transferencia", label: "Transferencia" },
                ];
                switches.forEach(({ id, label }) => {
                  
                    const div = document.createElement("div");
                    div.className = "form-check form-switch";
                    div.style = 'margin: 15px;';

                    const input = document.createElement("input");
                    input.className = "form-check-input";
                    input.type = "checkbox";
                    input.id = id;
                    input.style.transform = "scale(1.5)";
                    input.style.marginRight = "20px";
                    input.setAttribute("tabindex", "-1");

                    const labelElement = document.createElement("label");
                    labelElement.className = "form-check-label";
                    labelElement.id = id + "Label";
                    labelElement.htmlFor = id;
                    labelElement.textContent = label;

                    // Evitar que el input reciba el enfoque y el estado "activo" al hacer clic
                    input.addEventListener("mousedown", (event) => {
                    event.preventDefault(); // Impide que el input reciba foco o el estado activo
                    });

                    // Opcional: evitar el enfoque visual completamente
                    input.addEventListener("focus", (event) => {
                    event.preventDefault(); // Impide que el input reciba foco
                    });

                    input.addEventListener("change", () => {

                        if (input.checked) {

                            document.querySelectorAll(".form-check-input").forEach((otherInput) => {

                                if (otherInput !== input) otherInput.checked = false;
                            });
                        }
                    });

                    div.appendChild(input);
                    div.appendChild(labelElement);
                    paymentContainer.appendChild(div);
                });
                function toggleDiv(checkboxId, divId) {
                    document.getElementById(checkboxId).addEventListener('change', function() {

                        const ocultaProductos = document.getElementById("ocultaProductos");
                        const cartProducts = document.querySelectorAll(".cart-product");
                        const separatorDiv = document.createElement('div');
                        

                        var input1 = document.getElementById('efectivo');
                        var radio1 = document.getElementById('radio1');
                        var radio2 = document.getElementById('radio2');
                        var efectivoSeparator = document.querySelector('.efectivo-separator');
                        var regreso = document.getElementById('regreso');

                        var input2 = document.getElementById('tarjeta');

                        var input3 = document.getElementById('transferencia');

                        var div1 = document.getElementById('div1');
                        var div2 = document.getElementById('div2');
                        var div3 = document.getElementById('div3');

                        const efectivoLabel = document.getElementById('efectivoLabel');
                        const tarjetaLabel = document.getElementById('tarjetaLabel');
                        const transferenciaLabel = document.getElementById('transferenciaLabel');

                        var validationMessage = document.getElementById('validationMessage');

                        const valueNumberDiv = document.querySelector(".cart-value-number");
                        total = parseFloat(valueNumberDiv.textContent.substring(2)) - com;

                        if (divId == 'div1') {

                            colorDisabling();
                            //ticketButton.style.display = "none";

                            valueNumberDiv.textContent = "$ " + total + ".00";

                            if (input1.checked) {

                                if (!first) {

                                    ocultaIcono.style.transform = "rotateZ(0deg)";

                                    ocultaProductos.style.display = "flex";
                                    document.querySelectorAll(".cart-product").forEach((cartProducts) => {
                                        cartProducts.style.display = "none";
                                    });
                                    document.querySelectorAll(".product-separator").forEach((separatorDiv) => {
                                        separatorDiv.style.display = "none";
                                    });

                                    first = true;
                                    desplegado = false
                                }

                                div1.style.display = 'block';

                                input1.style.borderColor = "";
                                input2.style.borderColor = "";
                                input3.style.borderColor = "";
                                efectivoLabel.style.color = "";
                                tarjetaLabel.style.color = "";
                                transferenciaLabel.style.color = "";
                            }
                            else {

                                div1.style.display = 'none';

                                cambioInsertar.style.display = 'flex';
                                cambioValueDiv.style.display = 'none';
                                cambioValue.textContent = "";
                                cambioInput.style.borderColor = "#ddd";
                                cambioInput.value = "";
                                
                                if (peso.classList.contains("on-currency")) {
                                    
                                    peso.style.backgroundColor = "#0D6EFD";
                                } else {
                                    dolar.style.backgroundColor = "#0D6EFD";
                                }

                                peso.style.pointerEvents = "auto";
                                dolar.style.pointerEvents = "auto";
                            }

                            div3.style.display = 'none';
                            div2.style.display = 'none';
                            
                            com = 0;

                            exacto.style.display = 'none';
                            radio1.checked = false;
                            cambio.style.display = 'none';
                            separatorDiv5.style.display = 'none';
                            divisaDiv.style.display = 'none';
                            radio2.checked = false;
                            efectivoSeparator.style.display = 'none';
                            regreso.style.display = 'none';
                            validationMessage.style.display = 'none';

                        } else if (divId == 'div2') {

                            const div2Text2 = document.getElementById("div2Text2");

                            com = Math.ceil(total / 20);

                            div21Text2.textContent = "$ " + total + ".00";
                            div22Text2.textContent = "+ $ " + com + ".00";
                            div1.style.display = 'none';

                            if (input2.checked) {
                            
                                colorEnabling();
                                //ticketButton.style.display = "flex";

                                if (!first) {

                                    ocultaIcono.style.transform = "rotateZ(0deg)";

                                    ocultaProductos.style.display = "flex";
                                    document.querySelectorAll(".cart-product").forEach((cartProducts) => {
                                        cartProducts.style.display = "none";
                                    });
                                    document.querySelectorAll(".product-separator").forEach((separatorDiv) => {
                                        separatorDiv.style.display = "none";
                                    });

                                    first = true;
                                    desplegado = false
                                }

                                div2.style.display = 'block';
                                valueNumberDiv.textContent = "$ " + (total + com) + ".00";

                                cambioInsertar.style.display = 'flex';
                                cambioValueDiv.style.display = 'none';
                                cambioValue.textContent = "";
                                cambioInput.style.borderColor = "#ddd";
                                cambioInput.value = "";

                                input1.style.borderColor = "";
                                input2.style.borderColor = "";
                                input3.style.borderColor = "";
                                efectivoLabel.style.color = "";
                                tarjetaLabel.style.color = "";
                                transferenciaLabel.style.color = "";
                                
                                if (peso.classList.contains("on-currency")) {
                                    
                                    peso.style.backgroundColor = "#0D6EFD";
                                } else {
                                    dolar.style.backgroundColor = "#0D6EFD";
                                }

                                peso.style.pointerEvents = "auto";
                                dolar.style.pointerEvents = "auto";
                            }
                            else {
                            
                                colorDisabling();
                            //ticketButton.style.display = "none";
                                
                                div2.style.display = 'none';
                                valueNumberDiv.textContent = "$ " + total + ".00";
                                com = 0;
                            }

                            div3.style.display = 'none';

                            exacto.style.display = 'none';
                            radio1.checked = false;
                            cambio.style.display = 'none';
                            separatorDiv5.style.display = 'none';
                            divisaDiv.style.display = 'none';
                            radio2.checked = false;
                            efectivoSeparator.style.display = 'none';
                            regreso.style.display = 'none';
                            validationMessage.style.display = 'none';

                        } else {

                            valueNumberDiv.textContent = "$ " + total + ".00";
                            
                            div1.style.display = 'none';
                            div2.style.display = 'none';

                            if (input3.checked) {
                            
                                colorEnabling();
                                //ticketButton.style.display = "flex";

                                if (!first) {

                                    ocultaIcono.style.transform = "rotateZ(0deg)";

                                    ocultaProductos.style.display = "flex";
                                    document.querySelectorAll(".cart-product").forEach((cartProducts) => {
                                        cartProducts.style.display = "none";
                                    });
                                    document.querySelectorAll(".product-separator").forEach((separatorDiv) => {
                                        separatorDiv.style.display = "none";
                                    });

                                    first = true;
                                    desplegado = false
                                }
                                
                                div3.style.display = 'flex';
                                
                                cambioInsertar.style.display = 'flex';
                                cambioValueDiv.style.display = 'none';
                                cambioValue.textContent = "";
                                cambioInput.style.borderColor = "#ddd";
                                cambioInput.value = "";

                                input1.style.borderColor = "";
                                input2.style.borderColor = "";
                                input3.style.borderColor = "";
                                efectivoLabel.style.color = "";
                                tarjetaLabel.style.color = "";
                                transferenciaLabel.style.color = "";
                                
                                if (peso.classList.contains("on-currency")) {
                                    
                                    peso.style.backgroundColor = "#0D6EFD";
                                } else {
                                    dolar.style.backgroundColor = "#0D6EFD";
                                }

                                peso.style.pointerEvents = "auto";
                                dolar.style.pointerEvents = "auto";
                            }
                            else {
                            
                            colorDisabling();
                            //ticketButton.style.display = "none";

                                div3.style.display = 'none';
                            }

                            com = 0;

                            exacto.style.display = 'none';
                            radio1.checked = false;
                            cambio.style.display = 'none';
                            separatorDiv5.style.display = 'none';
                            divisaDiv.style.display = 'none';
                            radio2.checked = false;
                            efectivoSeparator.style.display = 'none';
                            regreso.style.display = 'none';
                            validationMessage.style.display = 'none';
                        }
                    });
                }
                toggleDiv('efectivo', 'div1');
                toggleDiv('tarjeta', 'div2');
                toggleDiv('transferencia', 'div3');

                // separador
                const separatorDiv = document.createElement('div');
                separatorDiv.className = 'cart-separator';
                separatorDiv.style.height = '1px';
                separatorDiv.style.backgroundColor = '#ddd';
                paymentContainer.appendChild(separatorDiv);
                //
                // EFECTIVO
                const div1 = document.createElement("div");
                div1.id = "div1";
                div1.style.display = "none";
                paymentContainer.appendChild(div1);

                    const div11 = document.createElement("div");
                    div11.id = "div11";
                    div11.style = "margin: 20px; display: flex; justify-content: start; align-item: center; gap: 20px;";
                    div1.appendChild(div11);

                        const radio1 = document.createElement("input");
                        radio1.type = "radio";
                        radio1.setAttribute('id', 'radio1');
                        radio1.style.transform = "scale(2)";
                        radio1.name = "grupo1";
                        radio1.addEventListener('change', function() {

                            const regreso = document.getElementById('regreso');
                            const cambioInput = document.getElementById('cambioInput');
                            var label1 = document.getElementById('label1');
                            var label2 = document.getElementById('label2');

                            if (radio1.checked) {

                                colorEnabling();
                                //ticketButton.style.display = "flex";

                                cambioInsertar.style.display = "flex";
                                cambioInput.value = "";
                                cambioValueDiv.style.display = "none";
                                cambioValue.textContent = "";
                                regresoValue.textContent = "$ 0.00"; 
                                exactoValue.textContent = "$ " + total + ".00";
                                
                                label1.style.color = "";
                                label2.style.color = "";
                                cambioInput.style.borderColor = "#ddd";

                                if (peso.classList.contains("on-currency")) {
                                    
                                    peso.style.backgroundColor = "#0D6EFD";
                                } else {
                                    dolar.style.backgroundColor = "#0D6EFD";
                                }

                                peso.style.pointerEvents = "auto";
                                dolar.style.pointerEvents = "auto";
                            }
                        });
                        div11.appendChild(radio1);

                        const label1 = document.createElement("label");
                        label1.id = "label1";
                        label1.textContent = "Cambio exacto";
                        div11.appendChild(label1);

                    const div12 = document.createElement("div");
                    div12.id = "div12";
                    div12.style = "margin: 20px; display: flex; justify-content: start; align-item: center; gap: 20px;";
                    div1.appendChild(div12);

                        const radio2 = document.createElement("input");
                        radio2.type = "radio";
                        radio2.setAttribute('id', 'radio2');
                        radio2.style.transform = "scale(2)";
                        radio2.name = "grupo1";
                        radio2.setAttribute('data-role', 'toggleChange');
                        radio2.addEventListener('change', function() {

                            var label1 = document.getElementById('label1');
                            var label2 = document.getElementById('label2');

                            if (radio2.checked) {

                                colorDisabling();
                            //ticketButton.style.display = "none";

                                label1.style.color = "";
                                label2.style.color = "";
                            }
                        });
                        div12.appendChild(radio2);

                        const label2 = document.createElement("label");
                        label2.id = "label2";
                        label2.textContent = "Otro monto";
                        div12.appendChild(label2);
            
                    const separatorDiv2 = document.createElement('div');
                    separatorDiv2.className = 'cart-separator';
                    separatorDiv2.style.height = '1px';
                    separatorDiv2.style.backgroundColor = '#ddd';
                    div1.appendChild(separatorDiv2);
                //
                // TARJETA
                const div2 = document.createElement("div");
                div2.id = "div2";
                div2.style = "color: #57a32e;";
                div2.style.display = "none";
                paymentContainer.appendChild(div2);
            
                    const div21 = document.createElement("div");
                    div21.id = "div2";
                    div21.style = "color: #666; display: flex; justify-content: space-between; margin-left: 15px; margin-right: 25px;";
                    div2.appendChild(div21);

                        const div21Text1 = document.createElement("div");
                        div21Text1.id = "div21Text1";
                        div21Text1.style.fontSize = "18px";
                        div21Text1.textContent = "Total:";
                        div21.appendChild(div21Text1);

                        const div21Text2 = document.createElement("div");
                        div21Text2.id = "div21Text2";
                        div21Text2.style.fontSize = "22px";
                        div21.appendChild(div21Text2);
                    
                    const div22 = document.createElement("div");
                    div22.id = "div2";
                    div22.style = "color: #57a32e; display: flex; justify-content: space-between; margin-left: 15px; margin-right: 25px;";
                    div2.appendChild(div22);

                        const div22Text1 = document.createElement("div");
                        div22Text1.id = "div22Text1";
                        div22Text1.style.fontSize = "18px";
                        div22Text1.textContent = "Comisión:";
                        div22.appendChild(div22Text1);

                        const div22Text2 = document.createElement("div");
                        div22Text2.id = "div22Text2";
                        div22Text2.style.fontSize = "22px";
                        div22.appendChild(div22Text2);
                //
                // TRANSFERENCIA
                const div3 = document.createElement("div");
                div3.id = "div3";
                div3.style = "display: none; align-items: start; gap: 8px; background-color: orange; color: white; padding: 15px; margin-bottom: 20px; border-radius: 10px;";
                paymentContainer.appendChild(div3);

                    const ImageDiv3 = document.createElement("img");
                    ImageDiv3.src = '../../images/exclamation-circle.svg';
                    ImageDiv3.style.marginTop = '5px';
                    div3.appendChild(ImageDiv3);

                    const TextDiv3 = document.createElement("div");
                    TextDiv3.color = "white";
                    TextDiv3.style = "font-size: 18px;";
                    TextDiv3.textContent = "Antes de realizar cualquier transferencia favor de confirmar el pedido con el vendedor.";
                    div3.appendChild(TextDiv3);
                //
                // CAMBIO EXACTO
                const exacto = document.createElement("div");
                exacto.id = "exacto";
                exacto.style = "display: none; justify-content: space-between; margin-top: 15px; padding-left: 15px; padding-right: 25px;";
                paymentContainer.appendChild(exacto);

                    const exactoText = document.createElement("div");
                    exactoText.id = "exactoText";
                    exactoText.style = "font-size: 18px;";
                    exactoText.textContent = "Paga con:";
                    exacto.appendChild(exactoText);

                    const exactoValue = document.createElement("div");
                    exactoValue.id = "exactoValue";
                    exactoValue.style = "font-size: 22px;";
                    exactoValue.textContent = "$ " + total + ".00";
                    exacto.appendChild(exactoValue);
                //
                // TIPO DE MONEDA
                const divisaDiv = document.createElement("div");
                divisaDiv.id = "divisaDiv";
                divisaDiv.textContent = "divisaDiv";
                divisaDiv.style = `display: none;
                    grid-template-columns: [start] 1fr [two] 1fr [end];
                    grid-template-rows: [start] 100% [end];
                    column-gap: 3px;
                    border-radius: 10px;
                    height: 50px;
                    overflow: hidden;
                    font-size: 22px;
                    color: white;`;
                paymentContainer.appendChild(divisaDiv);
                    //
                    // PESO MEXICANO
                    const peso = document.createElement("div");
                    peso.id = "peso";
                    peso.className = "on-currency peso";
                    peso.style = `background-color: #0D6EFD;
                        border-radius: 10px 0px 0px 10px;
                        color: white;
                        display: flex;
                        justify-content: center;
                        overflow: hidden;
                        align-items: center;
                        grid-column-start: start;  
                        grid-column-end: two;   
                        grid-row-start: start;    
                        grid-row-end: end;    
                    `;
                    peso.addEventListener("click", () => {

                        if (peso.classList.contains("off-currency")) {
                            
                            peso.style.border = "0px";
                            peso.style.backgroundColor = "#0D6EFD";
                            peso.style.color = "#fff";
                            
                            dolar.style.border = "1px solid #ccc";
                            dolar.style.backgroundColor = "#fff";
                            dolar.style.color = "#777";

                            if (cambioInput) {
                                
                                let change = cambioInput.value;
                                cambioInput.value = (change*18.50).toFixed(2);
                                
                                if (cambioInput.value == 0) {
                                    cambioInput.value = "";
                                }
                                if (cambioInput.value > 999) {
                                    cambioInput.value = 999;
                                }
                            }

                            peso.className = "on-currency peso";
                            dolar.className = "off-currency dolar";
                        }
                    });
                    divisaDiv.appendChild(peso);
                        
                        const pesoText = document.createElement("div");
                        pesoText.textContent = "MXN";
                        peso.appendChild(pesoText);

                    //
                    // DOLAR ESTADOUNIDENSE
                    const dolar = document.createElement("div");
                    dolar.id = "dolar";
                    dolar.className = "off-currency dolar";
                    dolar.style = `background-color: white;
                        border: 1px solid #ccc;
                        border-radius: 0px 10px 10px 0px;
                        color: #777;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        grid-column-start: two;    
                        grid-column-end: end;   
                        grid-row-start: start;    
                        grid-row-end: end;    
                    `;
                    dolar.addEventListener("click", () => {

                        if (dolar.classList.contains("off-currency")) {
                            
                            peso.style.border = "1px solid #ccc";
                            peso.style.backgroundColor = "#fff";
                            peso.style.color = "#777";

                            dolar.style.border = "0px";
                            dolar.style.backgroundColor = "#0D6EFD";
                            dolar.style.color = "#fff";

                            if (cambioInput) {
                                
                                let change = cambioInput.value;
                                cambioInput.value = (change/18.5).toFixed(2);
                                
                                if (cambioInput.value == 0) {
                                    cambioInput.value = "";
                                }
                                if (cambioInput.value > 54) {
                                    cambioInput.value = 54;
                                }
                            }

                            peso.className = "off-currency peso";
                            dolar.className = "on-currency dolar";
                        }
                    });
                    divisaDiv.appendChild(dolar);
                        
                        const dolarText = document.createElement("div");
                        dolarText.textContent = "USD";
                        dolar.appendChild(dolarText);
                //
                // separador
                const separatorDiv5 = document.createElement('div');
                separatorDiv5.id = 'separatorDiv5';
                separatorDiv5.className = 'cart-separator';
                separatorDiv5.style.display = 'none';
                separatorDiv5.style.height = '1px';
                separatorDiv5.style.backgroundColor = '#ddd';
                paymentContainer.appendChild(separatorDiv5);
                //
                //  AVISO DE PAGO INCOMLETO - (elemento cambio)
                const validationMessage = document.createElement("div");
                validationMessage.id = "validationMessage";
                validationMessage.style = 'display: none; align-items: start; background-color: orange; color: white; gap: 8px; padding: 15px; margin-bottom: 10px; border-radius: 10px;';
                paymentContainer.appendChild(validationMessage);

                    const ImageAdvice5 = document.createElement("img");
                    ImageAdvice5.src = '../../images/exclamation-circle.svg';
                    ImageAdvice5.style.marginTop = '5px';
                    validationMessage.appendChild(ImageAdvice5);

                    const TextAdvice5 = document.createElement("div");
                    TextAdvice5.color = "white";
                    TextAdvice5.style = "font-size: 18px;";
                    TextAdvice5.textContent = "La cantidad ingresada es menor que el total.";
                    validationMessage.appendChild(TextAdvice5);
                //
                //  CAMBIO CON DEVOLUCIÓN
                const cambio = document.createElement("div");
                cambio.id = "cambio";
                cambio.style = "display: none; justify-content: space-between; align-items: end; padding-left: 15px; padding-right: 15px; padding-bottom: 10px;";
                paymentContainer.appendChild(cambio);
                    //
                    // CANTIDAD: ___
                    const cambioText = document.createElement("div");
                    cambioText.style.fontSize = "18px";
                    cambioText.style.color = "#777";
                    cambioText.textContent = "cantidad: ";
                    cambio.appendChild(cambioText);
                    //
                    // CAMBIO INPUT
                    const cambioInsertar = document.createElement('div');
                    cambioInsertar.id = "cambioInsertar";
                    cambioInsertar.style = "display: flex; align-items: center; width: auto; margin-top: 10px;";
                    cambio.appendChild(cambioInsertar);

                        const cambioSymbol = document.createElement("div");
                        cambioSymbol.textContent = "$";
                        cambioSymbol.style.fontSize = "30px";
                        cambioSymbol.style.color = "gray";
                        cambioInsertar.appendChild(cambioSymbol);

                        const cambioSpace = document.createElement("div");
                        cambioSpace.style.width = "10px";
                        cambioInsertar.appendChild(cambioSpace);

                        const cambioInput = document.createElement("input");
                        cambioInput.id = "cambioInput";
                        cambioInput.type = "number";
                        cambioInput.step = "0.01";
                        cambioInput.style = "padding-left: 10px; height: 50px; width: 120px; border-radius: 10px 0px 0px 10px; border: 2px solid #ddd; border-right: none; font-size: 25px;";
                        cambioInput.addEventListener("input", () => {

                            if (peso.classList.contains("on-currency")) {
                                
                                if (cambioInput.value > 999) {
                                    cambioInput.value = 999;
                                }
                            } else if (dolar.classList.contains("on-currency")) {

                                if (cambioInput.value > 54) {
                                    cambioInput.value = 54;
                                }
                            }
                        });
                        cambioInput.addEventListener("input", () => {

                            const value = cambioInput.value;

                            // Limitar a dos decimales
                            if (value.includes(".")) {
                                const [integer, decimal] = value.split(".");
                                if (decimal.length > 2) {
                                    cambioInput.value = `${integer}.${decimal.slice(0, 2)}`;
                                }
                            }
                        });
                        cambioInput.addEventListener("input", () => {

                            if (cambioInput.value.trim() !== "") {
                                // Si tiene contenido, cambia el color del borde
                                cambioInput.style.borderColor = "#ddd";
                            }
                        });
                        cambioInput.addEventListener("focus", () => {
                            if (coolNavbar) {
                                coolNavbar.style.display = "none";
                            }
                        });
                        cambioInput.addEventListener("blur", () => {
                            if (coolNavbar) {
                                coolNavbar.style.display = "flex";
                            }
                        });
                        cambioInsertar.appendChild(cambioInput);

                        const cambioEnter = document.createElement("div");
                        cambioEnter.style = " background-color: #0D6EFD; display: flex; justify-content: center; align-items: center; height: 50px; width: 50px; border-radius: 0px 10px 10px 0px;";
                        cambioEnter.addEventListener("click", () => {

                            const validationMessage = document.getElementById("validationMessage"); 

                            document.querySelectorAll(".cart-quantity-minus").forEach((cartMinus) => {
                                
                                cartMinus.style.backgroundColor = "lightgray";
                                cartMinus.style.pointerEvents = "none";
                            });
                            document.querySelectorAll(".cart-quantity-plus").forEach((cartPlus) => {
                                
                                cartPlus.style.backgroundColor = "lightgray";
                                cartPlus.style.pointerEvents = "none";
                            });
                            
                            const divisaDiv = document.getElementById("divisaDiv"); 
                            const regreso = document.getElementById("regreso"); 
                            const cambioInput = document.getElementById("cambioInput");
                            let contenido = parseFloat(cambioInput.value);

                            const cartValueNumber = document.querySelector('.cart-value-number');
                            let contenidoTexto = cartValueNumber.textContent;
                            contenidoTexto = parseFloat(contenidoTexto.substring(2));

                            if (dolar.classList.contains("on-currency")) {

                                contenido = parseFloat(cambioInput.value) * 18.5;
                            }

                            if (contenido >= contenidoTexto) {
                                
                                colorEnabling();
                                //ticketButton.style.display = "flex";
                                
                                const inputValue = contenido;
                                efectivoSeparator.style.display = "block";
                                cambioValue.textContent = "$ " + inputValue.toFixed(2);
                                cambioValueDiv.style.display = "flex";
                                cambioInsertar.style.display = "none";
                                regreso.style.display = "flex";
                                regresoValue.textContent = "$ " + (contenido - contenidoTexto).toFixed(2);
                                cambio.style.paddingRight = "5px";
                                validationMessage.style.display = "none";
                                cambioInsertar.style.marginRight = "10px";

                                if (peso.classList.contains("on-currency")) {
                                    
                                    peso.style.backgroundColor = "lightgray";
                                } else {
                                    dolar.style.backgroundColor = "lightgray";
                                }

                                peso.style.pointerEvents = "none";
                                dolar.style.pointerEvents = "none";

                            } else {
                                validationMessage.style.display = "flex";
                            }
                        });
                        cambioInsertar.appendChild(cambioEnter);

                            const imagenEnter = document.createElement("img");
                            imagenEnter.src = "../../images/arrow-return-right.svg";
                            cambioEnter.appendChild(imagenEnter);
                    //
                    // CAMBIO INSERTADO
                    const cambioValueDiv = document.createElement("div");
                    cambioValueDiv.id = "cambioValueDiv";
                    cambioValueDiv.style.display = "none";
                    cambioValueDiv.style.gap = "10px";
                    cambioValueDiv.addEventListener("click", () => {

                        colorDisabling();
                            //ticketButton.style.display = "none";

                        const inputValue = cambioInput.value;
                        efectivoSeparator.style.display = "none";
                        regreso.style.display = "none";
                        cambioValue.textContent = "";
                        cambioValueDiv.style.display = "none";
                        cambioInsertar.style.display = "flex";
                        cambioInsertar.style.marginRight = "-10px";
                        cambio.style.paddingRight = "25px";
                        cambioInput.focus();
                        
                        if (peso.classList.contains("on-currency")) {
                                    
                            peso.style.backgroundColor = "#0D6EFD";
                        } else {
                            dolar.style.backgroundColor = "#0D6EFD";
                        }

                        peso.style.pointerEvents = "auto";
                        dolar.style.pointerEvents = "auto";

                        document.querySelectorAll(".cart-quantity-minus").forEach((cartMinus) => {
                                
                            cartMinus.style.backgroundColor = "#e64747";
                            cartMinus.style.pointerEvents = "auto";
                        });
                        document.querySelectorAll(".cart-quantity-plus").forEach((cartPlus) => {
                            
                            cartPlus.style.backgroundColor = "#e64747";
                            cartPlus.style.pointerEvents = "auto";
                        });
                                
                    });
                    cambio.appendChild(cambioValueDiv);
                
                        const cambioValue = document.createElement("div");
                        cambioValue.id = "cambioValue";
                        cambioValue.textContent = "";
                        cambioValue.style = "font-size: 22px;";
                        cambioValue.style.color = "gray";
                        cambioValueDiv.appendChild(cambioValue);
                        
                        const cambioEdit = document.createElement("img");
                        cambioEdit.src = "../../images/pencil.svg";
                        cambioValueDiv.appendChild(cambioEdit);
                //
                // Función que detecta el estado del checkbox y muestra/oculta el div
                function toggleRadio(radioButtonId, divId) {
                    document.getElementById(radioButtonId).addEventListener('change', function() {

                        var radio1 = document.getElementById('radio1');
                        var radio2 = document.getElementById('radio2');

                        var exacto = document.getElementById('exacto');
                        var regreso = document.getElementById('regreso');
                        var cambio = document.getElementById('cambio');

                        const efectivoSeparator = document.querySelector('.efectivo-separator');

                        if (divId == 'exacto') {

                            exacto.style.display = 'flex';
                            regreso.style.display = 'flex';
                            cambio.style.display = 'none';
                            separatorDiv5.style.display = 'none';
                            divisaDiv.style.display = 'none';
                            efectivoSeparator.style.display = 'block';
                            validationMessage.style.display = 'none';

                        } else if (divId == 'cambio') {

                            exacto.style.display = 'none';
                            regreso.style.display = 'none';
                            cambio.style.display = 'flex';
                            divisaDiv.style.display = 'grid';
                            separatorDiv5.style.display = 'block';
                            efectivoSeparator.style.display = 'none';

                        }
                    });
                }

                toggleRadio('radio1', 'exacto');
                toggleRadio('radio2', 'cambio');

        } else { // CUANDO NO HAY USUARIO ACTIVO

            const paymentContainer = document.createElement('div');
            paymentContainer.className = 'payment-container';
            cartProductsContainer.appendChild(paymentContainer);

                const adviceDiv = document.createElement('div');
                adviceDiv.id = "adviceDiv";
                adviceDiv.style = 'display: flex; align-items: start; background-color: orange; color: white; gap: 8px; padding: 15px; margin-top: 10px; margin-bottom: 10px; border-radius: 10px;';
                paymentContainer.appendChild(adviceDiv);

                const ImageAdvice3 = document.createElement("img");
                ImageAdvice3.src = '../../images/exclamation-circle.svg';
                ImageAdvice3.style.marginTop = '5px';
                adviceDiv.appendChild(ImageAdvice3);

                const TextAdvice3 = document.createElement("div");
                TextAdvice3.color = "white";
                TextAdvice3.style = "font-size: 18px;";
                TextAdvice3.textContent = "Para tener disponible el servicio a domicilio inicie sesión.";
                adviceDiv.appendChild(TextAdvice3);

                // separador
                const separatorDiv = document.createElement('div');
                separatorDiv.className = 'cart-separator';
                separatorDiv.style.height = '1px';
                separatorDiv.style.backgroundColor = '#ddd';
                paymentContainer.appendChild(separatorDiv);
        }

        // SUBTOTAL

        const valueDiv = document.createElement('div');
        valueDiv.className = 'cart-value';
        cartProductsContainer.appendChild(valueDiv);
        
            const valueStringDiv = document.createElement('div');
            valueStringDiv.className = 'cart-value-string';
            valueStringDiv.textContent = 'Subtotal:';
            valueStringDiv.style.fontSize = '20px';
            valueStringDiv.style.paddingBottom = '5px';
            valueDiv.appendChild(valueStringDiv);

            const valueNumberDiv = document.createElement('div');
            valueNumberDiv.className = 'cart-value-number';
            valueNumberDiv.textContent = '$ ' + total + '.00';
            valueDiv.appendChild(valueNumberDiv);
        //
        // separador
        const efectivoSeparator = document.createElement('div');
        efectivoSeparator.className = 'efectivo-separator';
        efectivoSeparator.style = 'display: none; height: 1px; background-color: #ddd;';
        cartProductsContainer.appendChild(efectivoSeparator);
        //
        // Cambio area inferior
        const regreso = document.createElement("div");
        regreso.id = "regreso";
        regreso.style = "display: none; justify-content: space-between; padding: 15px 25px 10px 15px;";
        cartProductsContainer.appendChild(regreso);

            const regresoText = document.createElement("div");
            regresoText.id = "regresoText";
            regresoText.style = "font-size: 18px;";
            regresoText.textContent = "Recibe:";
            regreso.appendChild(regresoText);

            const regresoValue = document.createElement("div");
            regresoValue.id = "regresoValue";
            regresoValue.style = "font-size: 22px;";
            regresoValue.textContent = "$ " + cambioVal + ".00";
            regreso.appendChild(regresoValue);

        //
    } else { // Cuando no haya productos en el carrito.

        noprods();
    }
});

function noprods(){
    
    if (loginButton) {
        loginButton.style = 'display: none;';
    }
    
    if (cartButton) {
        cartButton.style = 'display: none;';
    }

    cartProductsContainer.style = 'display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 30px;';

    const iconDiv = document.createElement('div');
    iconDiv.style = 'margin-top: 40px;';
    cartProductsContainer.appendChild(iconDiv);

    const iconImageDiv = document.createElement('img');
    iconImageDiv.src = '../../images/cart-red.svg';
    iconDiv.appendChild(iconImageDiv);

    const noProductsMessageDiv = document.createElement('div');
    noProductsMessageDiv.textContent = 'No hay productos en tu carrito.';
    noProductsMessageDiv.style = 'font-size: 25px; text-align: center; font-weight: bold;';
    cartProductsContainer.appendChild(noProductsMessageDiv);

    const adviceDiv = document.createElement('div');
    adviceDiv.textContent = 'Puedes añadir productos usando en buscador o en la sección de departamentos.';
    adviceDiv.style.cssText = 'font-size: 18px; text-align: center;';
    cartProductsContainer.appendChild(adviceDiv);

    const redirectButtonDiv = document.createElement('a');
    redirectButtonDiv.href = '../../';
    redirectButtonDiv.className = 'red';
    redirectButtonDiv.style = 'margin-bottom: 40px; height: 60px; width: 90%; border-radius: 10px; color: white; display: flex; align-items: center; justify-content: center;';
    cartProductsContainer.appendChild(redirectButtonDiv);

    const redirectButtonText = document.createElement('div');
    redirectButtonText.className = 'red';
    redirectButtonText.style = 'font-weight: bold; font-size: 20px;';
    redirectButtonText.textContent = 'Continuar comprando';
    redirectButtonDiv.appendChild(redirectButtonText);

    if (cartRedirect) {
        cartRedirect.style = 'display: none;';
    }
}

const boxCatalog = document.querySelector('.box-catalog');

function adjustHeight() {

    const bar = document.querySelector('.bar');
    const coolNavbar = document.querySelector('.cool-navbar');
    const cartElement = document.querySelector('.cart-elements');

    const estilo = getComputedStyle(cartElement);
    const padding = parseFloat(estilo.padding);
    const cartElementHeight = parseFloat(getComputedStyle(cartElement).height);
    let lessHeight;

    if (coolNavbar) {lessHeight = cartElementHeight + (padding * 2);}

    else {
        const barHeight = parseFloat(getComputedStyle(bar).height);

        lessHeight = cartElementHeight + barHeight + (padding * 2);
    }

    const totalHeight = window.innerHeight - lessHeight;

}

if (!(cartArray && cartArray.length > 0)) {
    
    window.addEventListener('resize', adjustHeight);
    window.addEventListener('scroll', adjustHeight);
    window.addEventListener('load', adjustHeight);
}

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

let initialViewportHeight = window.innerHeight;

window.addEventListener('resize', () => {
    const currentViewportHeight = window.innerHeight;

    if (currentViewportHeight < initialViewportHeight) {
        // Asume que el teclado está visible
        document.body.style.height = `${currentViewportHeight}px`;
        document.body.style.overflow = 'hidden';
    } else {
        // El teclado está oculto
        document.body.style.height = '';
        document.body.style.overflow = '';
    }
});

function colorEnabling() {
        
    cartButton.style.backgroundColor = "#0D6EFD";
    cartButton.style.color = "#fff";
    cartButton.style.userSelect = "auto";/*
    ticketButton.style.backgroundColor = "#fff";
    ticketButton.style.color = "#0D6EFD";
    ticketButton.style.outline = "2px solid #0D6EFD";
    ticketButton.style.userSelect = "auto";*/
}

function colorDisabling() {

    cartButton.style.backgroundColor = "#999";
    cartButton.style.color = "#fff";
    cartButton.style.userSelect = "none";/*
    ticketButton.style.backgroundColor = "";
    ticketButton.style.color = "#999";
    ticketButton.style.outline = "2px solid #999";
    ticketButton.style.userSelect = "none";*/
}

/*
function restart() {
    
    // Restablecer el estado del carrito
    const input1 = document.getElementById('input1');
    const input2 = document.getElementById('input2');
    const input3 = document.getElementById('input3');

    input1.checked = false;
    input2.checked = false;
    input3.checked = false;

}
    
restart();

*/

</script>