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
                stocked = true;
                break;

            } else {

                sesionArray[i].productQuantity += productQuantity;
                document.getElementById('cantidad' + productId).innerHTML = sesionArray[i].productQuantity;
                cartUpdate(productId,productPrice,sesionArray[i].productQuantity,true);
                stocked = true;
                break;
            }
        }
    }

    if (!stocked) {

        sesionArray.push({productId, productDescription, productDepartment, productPrice, productImage, productQuantity});
        document.getElementById('cantidad' + productId).innerHTML = "1";
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
                break;

            } else {

                sesionArray[i].productQuantity -= productQuantity; // Restar la cantidad del producto
                document.getElementById('cantidad' + productId).innerHTML = sesionArray[i].productQuantity; // Actualizar la cantidad en la interfaz
                cartUpdate(productId, productPrice, sesionArray[i].productQuantity, false); // Actualizar el carrito
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

    if (document.querySelector('.cart-value-number')) {
        
        const cartValueNumber = document.querySelector('.cart-value-number');
        let contenidoTexto = cartValueNumber.textContent;
        contenidoTexto = contenidoTexto.substring(2);
        contenidoTexto = parseFloat(contenidoTexto);

        const cartFullPrice = document.getElementById('full' + productId);
        cartFullPrice.textContent = '$ ' + productPrice*productQuantity + '.00';

        contenidoTexto += isAdd ? parseFloat(productPrice) : -parseFloat(productPrice);

        cartValueNumber.textContent = '$ ' + contenidoTexto + '.00';
    }
}