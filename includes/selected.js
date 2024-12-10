
// page load
let quantity;
let sesionArray;
let stocked;



if (sessionStorage.getItem('carrito')) {

    sesionArray = JSON.parse(sessionStorage.getItem('carrito'));

} else {

    sesionArray = [];
}

// onclick
function add(productId, productDescription, productPrice, productImage, productQuantity) {

    stocked = false;

    for (let i = 0; i<sesionArray.length; i++) {

        if (sesionArray[i].productId === productId) {

            sesionArray[i].productQuantity += productQuantity;
            document.getElementById('cantidad' + productId).innerHTML = sesionArray[i].productQuantity;
            stocked = true;
            break;
        }
    }

    if (!stocked) {

        sesionArray.push({productId, productDescription, productPrice, productImage, productQuantity});
        document.getElementById('cantidad' + productId).innerHTML = "1";
        gridding(productId);
    }

    sessionStorage.setItem('carrito', JSON.stringify(sesionArray));
}

function remove(productId, productQuantity){

    let stocked = false;

    for (let i = 0; i<sesionArray.length; i++) {

        if (sesionArray[i].productId === productId) {

            if (sesionArray[i].productQuantity === 1) {

                sesionArray.splice(i, 1);
                gridding(productId);
                break;

            } else {

                sesionArray[i].productQuantity -= productQuantity;
                document.getElementById('cantidad' + productId).innerHTML = sesionArray[i].productQuantity;
                break;
            }
        }
    }

    sessionStorage.setItem('carrito', JSON.stringify(sesionArray));
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