let quantity;
let sesionArray;
let stocked;

if (sessionStorage.getItem('carrito')) {

    sesionArray = JSON.parse(sessionStorage.getItem('carrito'));

} else {

    sesionArray = [];
}

// onclick
function add(productId, productDescription, productDepartment, productPrice, productImage, productQuantity) {

    stocked = false;
    const quantityMinusDiv = document.querySelectorAll('.cart-quantity-minus');

    for (let i = 0; i<sesionArray.length; i++) {

        if (sesionArray[i].productId === productId) {

            if (sesionArray[i].productQuantity === 1) {

                if (quantityMinusDiv) {

                    quantityMinusDiv.forEach((div) => {
                        
                        const dataId = div.getAttribute('data-id'); // Obtenemos el valor de la propiedad data-id
                        
                        if (dataId == productId) {

                            div.setAttribute('onclick', 'remove(' + productId + ',\''+ productPrice +'\',1)');
                        }
                    });

                } else {
                    console.log("El elemento cart-quantity-minus no existe.");
                }

                sesionArray[i].productQuantity += productQuantity;
                document.getElementById('cantidad' + productId).innerHTML = sesionArray[i].productQuantity;
                cartUpdate(productId,productPrice,sesionArray[i].productQuantity,true);
                iconNotification(productQuantity,true);
                stocked = true;
                break;

            } else {

                sesionArray[i].productQuantity += productQuantity;
                document.getElementById('cantidad' + productId).innerHTML = sesionArray[i].productQuantity;
                cartUpdate(productId,productPrice,sesionArray[i].productQuantity,true);
                iconNotification(productQuantity,true);
                stocked = true;
                break;
            }
        }
    }

    if (!stocked) {

        sesionArray.push({productId, productDescription, productDepartment, productPrice, productImage, productQuantity});
        document.getElementById('cantidad' + productId).innerHTML = "1";
        iconNotification(productQuantity,true);
        gridding(productId);
    }

    sessionStorage.setItem('carrito', JSON.stringify(sesionArray));
}

function remove(productId, productPrice, productQuantity) {

    const quantityMinusDiv = document.querySelectorAll('.cart-quantity-minus');

    for (let i = 0; i < sesionArray.length; i++) {

        if (sesionArray[i].productId === productId) {

            if (sesionArray[i].productQuantity === 1) {

                sesionArray.splice(i, 1); // Eliminar el producto del carrito
                gridding(productId); // Actualizar la visualización del carrito
                iconNotification(productQuantity,false);
                break;

            } else if (sesionArray[i].productQuantity === 2) {
                
                // Verifica si el elemento existe antes de intentar establecer el 'onclick'
                if (quantityMinusDiv) {
                    
                    quantityMinusDiv.forEach((div) => {
                        
                        const dataId = div.getAttribute('data-id'); // Obtenemos el valor de la propiedad data-id
                        
                        if (dataId == productId) {

                            div.setAttribute('onclick', 'alert(' + productId + ')');
                        }
                    });

                }

                sesionArray[i].productQuantity -= productQuantity; // Restar la cantidad del producto
                document.getElementById('cantidad' + productId).innerHTML = sesionArray[i].productQuantity; // Actualizar la cantidad en la interfaz
                cartUpdate(productId, productPrice, sesionArray[i].productQuantity, false); // Actualizar el carrito
                iconNotification(productQuantity,false);
                break;

            } else {

                sesionArray[i].productQuantity -= productQuantity; // Restar la cantidad del producto
                document.getElementById('cantidad' + productId).innerHTML = sesionArray[i].productQuantity; // Actualizar la cantidad en la interfaz
                cartUpdate(productId, productPrice, sesionArray[i].productQuantity, false); // Actualizar el carrito
                iconNotification(productQuantity,false);
                break;
            }
        }
    }

    sessionStorage.setItem('carrito', JSON.stringify(sesionArray)); // Guardar el carrito actualizado
}
    
function gridding(productId) {
 
    const box = document.querySelectorAll('.box-product');

    box.forEach(element => {

        if (element.id == productId) {
            
            const plus = element.querySelector('.plus');
            const minus = element.querySelector('.minus');
            const quantity = element.querySelector('.quantity');
            const plusImage = element.querySelector('.plus-image');
            const plusString = element.querySelector('.plus-string');
            
            if (plus.classList.contains('short')) {
                
                minus.classList.remove('box-product-button-show');
                quantity.classList.remove('box-product-button-show');
                plusImage.style.display = "none";
                plusString.style.display = "block";
                plus.classList.remove('short');

            } else {

                minus.classList.add('box-product-button-show');
                quantity.classList.add('box-product-button-show');
                plusImage.style.display = "block";
                plusString.style.display = "none";
                plus.classList.add('short');
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
     
    const box = document.querySelectorAll('.box-product');

    box.forEach(element => {
        
        for (let i = 0; i<sesionArray.length; i++) {

            if (sesionArray[i].productId == element.id) {
                
                const plus = element.querySelector('.plus');
                const minus = element.querySelector('.minus');
                const quantity = element.querySelector('.quantity');
                const plusImage = element.querySelector('.plus-image');
                const plusString = element.querySelector('.plus-string');
                const cantidadElement = element.querySelector(`#cantidad${element.id}`);
    
                minus.classList.add('box-product-button-show');
                quantity.classList.add('box-product-button-show');
                plusImage.style.display = "block";
                plusString.style.display = "none";
                plus.classList.add('short');

                if (cantidadElement) {
                    cantidadElement.innerHTML = sesionArray[i].productQuantity;
                }
                break;
            }
        }
    });
});

function cartUpdate(productId,productPrice,productQuantity,isAdd) { 

    const cartButton = document.querySelector('.cart-button');
    const valueNumberDiv = document.querySelector('.cart-value-number');

    if (document.querySelector('.cart-value-number')) {
        
        const noPaymentContainer = document.querySelector('.nopayment-container');
        const paymentContainer = document.querySelector('.payment-container');

        const exactoValue = document.getElementById("exactoValue");

        const user = document.querySelector(".profile-picture");
        

        var input1 = document.getElementById('efectivo');
        var radio1 = document.getElementById('radio1');
        var radio2 = document.getElementById('radio2');
        var efectivoSeparator = document.querySelector('.efectivo-separator');
        var exacto = document.getElementById('exacto');
        var regreso = document.getElementById('regreso');

        var input2 = document.getElementById('tarjeta');

        var input3 = document.getElementById('transferencia');

        var div1 = document.getElementById('div1');
        var div2 = document.getElementById('div2');
        var div3 = document.getElementById('div3');


        const cartValueNumber = document.querySelector('.cart-value-number');
        let contenidoTexto = cartValueNumber.textContent;
        contenidoTexto = contenidoTexto.substring(2);
        contenidoTexto = parseFloat(contenidoTexto);
        
        var input2 = document.getElementById('tarjeta'); 
        var total_view = document.getElementById('div21Text2'); 
        var commission = document.getElementById('div22Text2'); 

        const cartFullPrice = document.getElementById('full' + productId);
        cartFullPrice.textContent = '$ ' + productPrice*productQuantity + '.00';

        contenidoTexto += isAdd ? parseFloat(productPrice) : -parseFloat(productPrice);

        const ocultaTexto = document.getElementById("ocultaTexto");
        let texto = ocultaTexto.textContent;
        let numero = parseFloat(texto.split(" ")[0]);

        if (isAdd) {numero += 1;}
        else {numero -= 1;}
         
        ocultaTexto.textContent = numero + " productos";   

        cartValueNumber.textContent = '$ ' + contenidoTexto + '.00';

        if (exactoValue) {

            exactoValue.textContent = cartValueNumber.textContent;
        }

        if (user) {
            
            total = parseFloat(valueNumberDiv.textContent.substring(2)) - com;
            
            if (total >= 50) {

                cartButton.style.display = 'flex';
                noPaymentContainer.style.display = 'none';
                paymentContainer.style.display = 'block';
            } else {

                cartButton.style.display = 'none';
                noPaymentContainer.style.display = 'block';
                paymentContainer.style.display = 'none';

                input1.checked = false;
                input2.checked = false;
                input3.checked = false;

                radio1.checked = false;
                cambio.style.display = 'none';
                radio2.checked = false;
                efectivoSeparator.style.display = 'none';
                exacto.style.display = 'none';
                regreso.style.display = 'none';
                
                div1.style.display = 'none';
                div2.style.display = 'none';
                div3.style.display = 'none';
            }
        }
    }


    if (input2) {
        
        if (input2.checked) {

            total = parseFloat(valueNumberDiv.textContent.substring(2)) - com;
            com = Math.ceil(total / 20);

            total_view.textContent = "$ " + total + ".00";
            commission.textContent = "+ $ " + com + ".00";

            valueNumberDiv.textContent = "$ " + (total + com) + ".00";
        }
    }
}
function iconNotification(productQuantity,isAdd) {

    const notificationNumber = document.querySelector('.notification-number');

    if (isAdd) {

        notificationNumber.style.display = 'flex';
        if (notificationNumber) {

            let contenidoTexto = notificationNumber.textContent != 0 ? notificationNumber.textContent : 0;
            contenidoTexto = parseFloat(contenidoTexto);
            contenidoTexto += productQuantity;
            notificationNumber.textContent = contenidoTexto;
        }

    } else {

        if (notificationNumber) {

            let contenidoTexto = notificationNumber.textContent;
            contenidoTexto -= productQuantity;
            if (contenidoTexto == 0) {

                notificationNumber.textContent = 0;
                notificationNumber.style.display = 'none';
            }
            notificationNumber.textContent = contenidoTexto;
        }
    }
}