<?php 

$bp = "../../includes/";
include $bp."dbconnect.php";

$query = "SELECT product_id, product_code, product_description, product_price FROM products";
$dataset = mysqli_query($Conn, $query);

$products = [];
while ($row = mysqli_fetch_assoc($dataset)) {
    $products[] = $row;
}


mysqli_close($Conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAJA 1</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        html{
            margin: 0;
            padding: 0;
            background-color: #ddd;
        }
        body{
            height: 100vh;
        }
        /* Para navegadores Webkit (Chrome, Safari, Edge) */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Para Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }
        .container{
            display: grid;
            grid-template-columns: 1fr 400px;
            height: 100vh;
        }
        .tools{
            display: grid;
            grid-template-rows: 20px 50px 40px 1fr;
        }
        .insertar{
            display: flex;
            gap: 5px;
            padding: 5px;
        }
        .visual-searcher{
            background-color: #fff;
        }
        .ticket{
            display: grid;
            grid-template-rows: 30px 660px auto;
        }
        .tabs{
            display: flex;
            background-color: lightgray;
        }
        .tab-plus{
            background-color: #ab2e41;
            font-weight: bold;
            font-size: 25px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: auto;
            aspect-ratio: 1 / 1;
        }
        .items{
            background-color: #fff;
            overflow-y: auto;
        }
        .total{
            background-color: #ab2e41;
            color: #fff;
            display: grid;
            grid-template-rows: 1fr 60px;
            padding: 10px;
            gap: 10px;
        }
        .received{
            display: flex;
            align-items: start;
            justify-content: space-between;
        }
        .change{
            display: flex;
            align-items: start;
            justify-content: space-between;
        }
        .subtotal{
            display: flex;
            align-items: start;
            justify-content: space-between;
            font-size: 80px;
        }
        iframe {
            width: 100%;  /* 100% of the width of the parent */
            height: 100%; /* 100% of the height of the parent */
            border: none; /* Optional: removes the border around the iframe */
        }
        #success-message {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../qz-tray.js"></script>
</head>
<body>
    <?php include "payment-popup.php"; ?>
    <div id="success-message">Datos insertados con éxito</div>
    <div class="container">
        <div class="tools">
            <div class="status">Trabajando...</div>
            <div style="font-size: 50px; font-weight: bold; padding-left: 10px;">
                MISCELANEA ANA
            </div>
            <div class="insertar">
                <input id=codigo type="text" style="height: 30px; font-size: 22px; padding-left: 5px;">
                <button id=agregar_codigo style="width: 120px; font-weight: bold; color: #333; font-size: 20px;">AÑADIR</button>
            </div>
            <div class="visual-searcher">
                <iframe src="dep.php" style="width: 100%;"></iframe>
            </div>
        </div>
        <div class="ticket">
            <div id=tabs class=tabs>
                <div id="tab-container" style="display: flex;"></div>
                <div style="order: 2;" id="tab-plus" class=tab-plus>
                    +
                </div>
            </div>
            <div class="items">
                <table style="width: 100%; border-spacing: 10px;">
                    <thead>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th width=60>importe</th> 
                    </thead>
                    <tbody id="tabla-body">

                        <!-- ELEMENTOS DEL TICKET -->

                    </tbody>
                </table>
            </div>
            <div class="total">
                <!--<div class="received">
                    <div style="font-size: 20px; font-family: Calibri, sans-serif;">Pagó con:</div>
                    <div id="efectivo" style="height: 100%; display: flex; gap: 10px;">
                        <div id="form" style="display: flex; height: 100%;">
                            <input maxlength="6" id="ticketInput" oninput="validateInput(this)" stpe="0.01" max="999.50" type="number" style="font-size: 18px; width: 100px;">
                            <div id="ticketEnter" onclick="paymentEnter()" style="
                                height: 100%;
                                width: 40px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                background-color: #aaa;
                                border-radius: 0px 5px 5px 0px;">
                                <img src="../../images/arrow-return-right.svg">
                            </div>
                        </div>
                        <div id="payment" style="font-size: 30px; font-family: Calibri, sans-serif;">

                        </div>
                        <div id="edit" onclick="paymentEdit()" style="display: none;">
                            <img src="pencil.svg">
                        </div>
                    </div>
                    <div id="tarjeta" style="display:none;">

                    </div>
                    <div id="transferencia" style="display:none;">

                    </div>
                </div>-->
                <div class="subtotal">
                    <div style="font-size: 20px; font-family: Calibri, sans-serif;">Subtotal:</div>
                    <div id=subtotal style="font-size: 65px; font-family: Calibri, sans-serif;">$ 0.00</div>
                </div>
                <div id="cobrar" style="
                    background-color: white;
                    color: red;
                    font-size: 28px;
                    display: flex;
                    align-items: center;
                    justify-content: center;">
                    Cobrar
                </div>
                <!--<div class="change">
                    <div style="font-size: 20px; font-family: Calibri, sans-serif;">Recibe:</div>
                    <div id="changeText" style="font-size: 30px; font-family: Calibri, sans-serif;"></div>
                </div>-->
            </div>
        </div>
    </div>
</body>
</html>

<script>
    
let maxTabs = 5;

// RECARGA LOS TICKETS EN PROCESO DE PAGO DEL LOCALSTORAGE
window.addEventListener('DOMContentLoaded', function() {

    let ticketId;
    let numTabs = 0;
    let tabs = localStorage.getItem('tabs') ? parseInt(localStorage.getItem('tabs')) : 1;
    let activo = localStorage.getItem('activo') ? parseInt(localStorage.getItem('activo')) : 1;
    let listas = JSON.parse(localStorage.getItem('listas')) ? JSON.parse(localStorage.getItem('listas')) : [1];
    
    if (tabs <= 1) {

        let tickets_available = [1,0,0,0,0];
        localStorage.setItem('tickets_available', JSON.stringify(tickets_available));
        tabContainer = document.getElementById('tab-container');
        const orden = document.createElement('div');
        orden.style = `
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2px;
            height: 100%;`;
        orden.id = 'orden' + listas[0];
        tabContainer.appendChild(orden);

            const pedido = document.createElement('div');
            pedido.textContent = 'Ticket ' + listas[0];
            pedido.setAttribute('onclick', 'ticketExchange(' + listas[0] + ')');

            orden.appendChild(pedido);

            const cancel = document.createElement('img');
            cancel.src = 'square-cancel.svg';
            cancel.id = 'cancel1';
            cancel.setAttribute('onclick', 'ticketRemove(' + listas[0] + ')');
            orden.appendChild(cancel);
    }

    else if (tabs > 1 && tabs <= maxTabs) {

        tabContainer = document.getElementById('tab-container');
        let listas = JSON.parse(localStorage.getItem('listas'));

        for (let i in listas) {

            let valor = listas[i];

            const orden = document.createElement('div');
            orden.style = `
                background: linear-gradient(0deg, #aaa 0%, #fff 70%);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2px;
                height: 100%;`;
            orden.id = 'orden' + valor;
            tabContainer.appendChild(orden);

                const pedido = document.createElement('div');
                pedido.textContent = 'Ticket ' + valor;
                pedido.setAttribute('onclick', 'ticketExchange(' + valor + ')');

                orden.appendChild(pedido);

                const cancel = document.createElement('img');
                cancel.src = 'square-cancel.svg';
                cancel.id = 'cancel' + valor;
                cancel.setAttribute('onclick', 'ticketRemove(' + valor + ')');
                orden.appendChild(cancel);
        }
        
        if (tabs == maxTabs) {
            const plus = document.getElementById('tab-plus');
            plus.style.display = 'none';
        }
    }

    setTab(activo);

    if (localStorage.getItem('listas')) {

        listas = JSON.parse(localStorage.getItem('listas'));
        activo = localStorage.getItem('activo');
        
        listas.forEach(function(numero) {

            if (localStorage.getItem('ticket' + numero)) {
                if (activo == numero) {
                    ticketReload(numero,0);
                }
                numTabs++;
            }
        });
        
        localStorage.setItem('tabs', numTabs);

    } else {

        numTabs = 1;
        localStorage.setItem('tabs', numTabs);
        enabledTicket = 1;
        localStorage.setItem('activo', enabledTicket);
        listas = [1];
        localStorage.setItem('listas', JSON.stringify(listas));
        ticket1 = [];
        localStorage.setItem('ticket1', JSON.stringify(ticket1));
    }

    if(localStorage.getItem('payment')){

    } else {

        let payment = [{

            ticket: 1,
            type: "efectivo",
            currency: "mxn",
            cash: null,
            subtotal: null,
            change: null
        }];

        localStorage.setItem('payment', JSON.stringify(payment));
    }

    totalGet();
});

// INGRESA UN PRODUCTO AL TICKET ACTIVO POR MEDIO DEL BUSCADOR VISUAL
window.addEventListener('message', (event) => {

    activo = localStorage.getItem('activo');

    const subtotal = document.getElementById('subtotal');

    let receivedItem = event.data;

    // Acceder a los valores del objeto recibido
    let productId = receivedItem.id;
    let productDescription = receivedItem.description;
    let productPrice = receivedItem.price;
    let productQuantity = receivedItem.quantity;

    let tickets = JSON.parse(localStorage.getItem('ticket' + activo)) || [];

    let existingProduct = tickets.findIndex(ticket => ticket.productId === productId);
    const tbody = document.getElementById('tabla-body');
    const item = document.createElement('tr');
    item.id = 'item' + productId;
    
    if (existingProduct !== -1) {

        tickets[existingProduct].productQuantity += 1;
        localStorage.setItem('ticket' + activo, JSON.stringify(tickets));

        // MODIFICAR TICKET EN LA INTERFAZ
        tbody.innerHTML = '';
        ticketReload(activo,0);

    } else {
        
        let ticket = {
            productId: productId,
            productDescription: productDescription,
            productPrice: productPrice,
            productQuantity: productQuantity
        };
        tickets.push(ticket);
        localStorage.setItem('ticket' + activo, JSON.stringify(tickets));
        //
        // CANTIDAD DEL PRODUCTO
        const element1 = document.createElement('td');
        element1.style.fontFamily = 'Calibri, sans-serif';
        element1.style.fontSize = '18px';
        element1.style.display = 'flex';
        element1.style.justifyContent = 'space-between';
        item.appendChild(element1);

            const arrowLeft = document.createElement('img');
            arrowLeft.setAttribute('onclick','ticketArrows(' + activo + ',' + productId + ',' + productPrice + ',0)');
            arrowLeft.src = 'caret-left-fill.svg';
            element1.appendChild(arrowLeft);

            const quantity = document.createElement('div');
            quantity.id = 'quantity' + productId;
            quantity.textContent = productQuantity;
            element1.appendChild(quantity);

            const arrowRight = document.createElement('img');
            arrowRight.setAttribute('onclick','ticketArrows(' + activo + ',' + productId + ',' + productPrice + ',1)');
            arrowRight.src = 'caret-right-fill.svg';
            element1.appendChild(arrowRight);
        //
        // DESCRIPCIÓN DEL PRODUCTO
        const element2 = document.createElement('td');
        element2.style.fontSize = '18px';
        element2.style.color = '#555';
        element2.style.justifyContent = 'space-between';
        element2.style.fontFamily = 'Calibri, sans-serif';
        element2.style.fontWeight = 'bold';
        element2.textContent = productDescription.toUpperCase();
        item.appendChild(element2);
        //
        // PRECIO DEL PRODUCTO
        const element3 = document.createElement('td');
        element3.style.fontFamily = 'Calibri, sans-serif';
        element3.id = 'import' + productId;
        element3.textContent = '$ ' + (productPrice).toFixed(2);
        item.appendChild(element3);

        tbody.appendChild(item);
        
        const separatorContainer = document.createElement('tr');
        separatorContainer.setAttribute('colspan', '3');
        separatorContainer.id = 'separator' + productId;

        const separator = document.createElement('td');
        separator.setAttribute('colspan', '3');
        separator.style.height = '1px';
        separator.style.width = '100%';
        separator.style.backgroundColor = '#bbb';
        separatorContainer.appendChild(separator);

        tbody.appendChild(separatorContainer);

        totalSet();
        totalGet();
    }
});

// INGRESA UN PRODUCTO AL TICKET ACTIVO POR CÓDIGO DE BARRAS
document.getElementById('agregar_codigo').addEventListener('click', function() {
  
    const activo = localStorage.getItem('activo');
    const dataset = <?= json_encode($products); ?>;
    const code = document.getElementById('codigo');
    const value = code.value;

    const producto = dataset.find(item => item.product_code === value);
    // Acceder a los valores del objeto recibido
    let productId = producto.product_id;
    let productDescription = producto.product_description;
    let productPrice = producto.product_price;

    let tickets = JSON.parse(localStorage.getItem('ticket' + activo));

    let existingProduct = tickets.findIndex(ticket => ticket.productId === productId);

    const tbody = document.getElementById('tabla-body');
    const subtotal = document.getElementById('subtotal');

    if (existingProduct !== -1) {

        tickets[existingProduct].productQuantity += 1;
        localStorage.setItem('ticket' + activo, JSON.stringify(tickets));

        // MODIFICAR TICKET EN LA INTERFAZ
        tbody.innerHTML = '';
        ticketReload(activo,1);

    } else {

        let ticket = {
            productId: productId,
            productDescription: productDescription,
            productPrice: parseFloat(productPrice),
            productQuantity: 1
        };
        tickets.push(ticket);
        localStorage.setItem('ticket' + activo, JSON.stringify(tickets));

        const item = document.createElement('tr');
        
        const element1 = document.createElement('td');
        element1.style.fontFamily = 'Calibri, sans-serif';
        element1.style.fontSize = '18px';
        element1.style.display = 'flex';
        element1.style.justifyContent = 'space-between';
        item.appendChild(element1);

            const arrowLeft = document.createElement('img');
            arrowLeft.src = 'caret-left-fill.svg';
            element1.appendChild(arrowLeft);

            const quantity = document.createElement('div');
            quantity.textContent = 1;
            element1.appendChild(quantity);

            const arrowRight = document.createElement('img');
            arrowRight.src = 'caret-right-fill.svg';
            element1.appendChild(arrowRight);
        
        const element2 = document.createElement('td');
        element2.style.fontSize = '18px';
        element2.style.color = '#555';
        element2.style.justifyContent = 'space-between';
        element2.style.fontFamily = 'Calibri, sans-serif';
        element2.style.fontWeight = 'bold';
        element2.textContent = productDescription.toUpperCase();
        item.appendChild(element2);
        
        const element3 = document.createElement('td');
        element3.style.fontFamily = 'Calibri, sans-serif';
        element3.textContent = '$ ' + parseFloat(productPrice).toFixed(2);
        item.appendChild(element3);

        tbody.appendChild(item);
            
        const separatorContainer = document.createElement('tr');
        separatorContainer.setAttribute('colspan', '3');

        const separator = document.createElement('td');
        separator.setAttribute('colspan', '3');
        separator.style.height = '1px';
        separator.style.width = '100%';
        separator.style.backgroundColor = '#bbb';
        separatorContainer.appendChild(separator);

        tbody.appendChild(separatorContainer);
        
        total = subtotal.textContent
        total = total.substring(2);
        total = parseFloat(total) + parseFloat(productPrice);

        subtotal.textContent = '$ ' + total.toFixed(2);
    }

    code.value = '';
});

function ticketReload(ticketId,isAdd){

    let total = 0;
    const tbody = document.getElementById('tabla-body');
    let tickets = JSON.parse(localStorage.getItem('ticket' + ticketId)) || [];
    let payment = JSON.parse(localStorage.getItem('payment')) || [];
    const subtotal = document.getElementById('subtotal');

    let centered = "display: flex; align-items: start; justify-content: center;";
    
    if (tickets) {
        
        tickets.forEach(elemento => {
            
            const item = document.createElement('tr');
            item.id = 'item' + elemento.productId;

            // CANTIDAD DE ELEMENTOS
            const element1 = document.createElement('td');
            element1.style.fontFamily = 'Calibri, sans-serif';
            element1.style.fontSize = '18px';
            element1.style.display = 'flex';
            element1.style.justifyContent = 'space-between';
            item.appendChild(element1);

                const arrowLeft = document.createElement('img');
                arrowLeft.setAttribute('onclick','ticketArrows(' + ticketId + ',' + elemento.productId + ',' + elemento.productPrice + ',0)');
                arrowLeft.src = 'caret-left-fill.svg';
                element1.appendChild(arrowLeft);

                const quantity = document.createElement('div');
                quantity.id = 'quantity' + elemento.productId;
                quantity.textContent = elemento.productQuantity;
                element1.appendChild(quantity);

                const arrowRight = document.createElement('img');
                arrowRight.style.textAlign = 'top';
                arrowRight.setAttribute('onclick','ticketArrows(' + ticketId + ',' + elemento.productId + ',' + elemento.productPrice + ',1)');
                arrowRight.src = 'caret-right-fill.svg';
                element1.appendChild(arrowRight);
            //
            // DESCRIPCIÓN DEL PRODUCTO
            const element2 = document.createElement('td');
            element2.style.fontSize = '18px';
            element2.style.color = '#555';
            element2.style.fontFamily = 'Calibri, sans-serif';
            element2.style.fontWeight = 'bold';
            element2.textContent = elemento.productDescription.toUpperCase();
            item.appendChild(element2);
            //
            // PRECIO DEL PRODUCTO
            const element3 = document.createElement('td');
            element3.style.fontFamily = 'Calibri, sans-serif';
            element3.id = 'import' + elemento.productId;
            element3.textContent = '$ ' + (elemento.productPrice*elemento.productQuantity).toFixed(2);
            item.appendChild(element3);

            tbody.appendChild(item);
            
            const separatorContainer = document.createElement('tr');
            separatorContainer.setAttribute('colspan', '3');
            separatorContainer.id = 'separator' + elemento.productId;

            const separator = document.createElement('td');
            separator.setAttribute('colspan', '3');
            separator.style.height = '1px';
            separator.style.width = '100%';
            separator.style.backgroundColor = '#bbb';
            separator.id = 'separator' + elemento.productId;
            separatorContainer.appendChild(separator);

            tbody.appendChild(separatorContainer);
        });

        totalSet();
        totalGet();
    }
}

document.getElementById('tab-plus').addEventListener('click', function() {

    tabContainer = document.getElementById('tab-container');
    plus = document.getElementById('tab-plus');
    tabs = localStorage.getItem('tabs');

    tabs++;
    localStorage.setItem('tabs', tabs);

    if (tabs <= maxTabs) {

        let highest;
        let tickets_available = JSON.parse(localStorage.getItem('tickets_available'));
        listas = JSON.parse(localStorage.getItem('listas'));

        for(let i=0; i<maxTabs; i++)
        {
            if(!tickets_available[i]) {
                highest = i;
                listas.push(i+1);
                localStorage.setItem('listas', JSON.stringify(listas))
                tickets_available[i] = 1;
                localStorage.setItem('tickets_available', JSON.stringify(tickets_available));
                break;
            }
        }

        ticket = [];

        localStorage.setItem('ticket' + (highest+1), JSON.stringify(ticket));

        const orden = document.createElement('div');
        orden.style = `
            background: linear-gradient(0deg, #aaa 0%, #fff 70%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2px;
            height: 100%;`;
        orden.id = 'orden' + (highest+1);
        tabContainer.appendChild(orden);

            const pedido = document.createElement('div');
            pedido.setAttribute('onclick', 'ticketExchange(' + (highest+1) + ')');
            pedido.textContent = 'Ticket ' + (highest+1);  
            orden.appendChild(pedido);

            const cancel = document.createElement('img');
            cancel.src = 'square-cancel.svg';
            cancel.id = 'cancel' + (highest+1);
            cancel.setAttribute('onclick', 'ticketRemove(' + (highest+1) + ')');
            orden.appendChild(cancel);

        if (tabs == maxTabs) {
            plus.style.display = 'none';
        }

        const payment = JSON.parse(localStorage.getItem('payment'));

        const newPayment = {

            ticket: (highest+1),
            type: "efectivo",
            currency: "mxn",
            cash: null,
            subtotal: null,
            change: null
        };

        payment.push(newPayment);
        localStorage.setItem('payment', JSON.stringify(payment));
    }
});

function ticketExchange(ticketPosition) {

    localStorage.setItem('activo', ticketPosition)
    const tbody = document.getElementById('tabla-body');
    document.getElementById('subtotal').textContent = '$ 0.00';
    tbody.innerHTML = '';
    document.getElementById('ticketInput').value = '';

    paymentEdit();

    setTab(ticketPosition);

    ticketReload(ticketPosition,0);

}

// RESALTA LA PESTAÑA ACTUAL
function setTab(ticketPosition){

    let listas = JSON.parse(localStorage.getItem('listas'));

    for (let i in listas) {

        let valor = listas[i];

        const pedido = document.getElementById('orden' + valor);
        
        if (ticketPosition == valor) {
            pedido.style.setProperty('background', '');
            pedido.style.backgroundColor = '#fff';

        } else {
            pedido.style.backgroundColor = '';
            pedido.style.setProperty('background', 'linear-gradient(0deg, #aaa 0%, #fff 70%)');

        }
    }
}

function ticketRemove(ticketId){

    const tbody = document.getElementById('tabla-body');
    let localTabs = localStorage.getItem('tabs');
    localTabs = parseInt(localTabs);

    if (localTabs === 1) {
        
        if (confirm("Se eliminarán los productos de este ticket ¿Estás de acuerdo?")) {

            localStorage.setItem('ticket' + ticketId, '[]');

            tbody.innerHTML = '';
            document.getElementById('subtotal').textContent = '$ 0.00';
        }
    
    } else {

        if (localStorage.getItem('ticket' + ticketId)) {
            
            let ticketData = JSON.parse(localStorage.getItem('ticket' + ticketId));
    
            // Comprueba si tiene elementos
            if (ticketData && Object.keys(ticketData).length > 0) {
                
                if (confirm("Se eliminarán los productos de este ticket ¿Estás de acuerdo?")) {

                    let activo = localStorage.getItem('activo');
                    activo = parseInt(activo);

                    if (ticketId === activo) {

                        let listas = JSON.parse(localStorage.getItem('listas'));
                        
                        for (let index = 0; index < listas.length; index++) {
                            const element = listas[index];
                            if (element === activo) {
                                activo = listas[index + 1] ? listas[index + 1] : listas[index - 1];
                                localStorage.setItem('activo', activo);
                                break;
                            }
                        }
                    }

                    let listas = JSON.parse(localStorage.getItem('listas'));
                    if (Array.isArray(listas)) {
                        listas = listas.filter(item => item !== ticketId);
                        localStorage.setItem('listas', JSON.stringify(listas));
                    }
                    localStorage.removeItem('ticket' + ticketId);
                    
                    let tickets_available = JSON.parse(localStorage.getItem('tickets_available'));
                    tickets_available[ticketId-1] = 0;
                    localStorage.setItem('tickets_available', JSON.stringify(tickets_available));

                    const pedido_remove = document.getElementById('orden' + ticketId);
                    pedido_remove.remove();

                    plus = document.getElementById('tab-plus');
                    plus.style.display = 'flex';

                    localStorage.setItem('tabs', (localTabs-1));
                    
                    ticketExchange(activo);
                }
            } else {

                let activo = localStorage.getItem('activo');
                activo = parseInt(activo);

                if (ticketId === activo) {

                    let listas = JSON.parse(localStorage.getItem('listas'));
                    
                    for (let index = 0; index < listas.length; index++) {
                        const element = listas[index];
                        if (element === activo) {
                            activo = listas[index + 1] ? listas[index + 1] : listas[index - 1];
                            localStorage.setItem('activo', activo);
                            break;
                        }
                    }
                }

                let listas = JSON.parse(localStorage.getItem('listas'));
                if (Array.isArray(listas)) {
                    listas = listas.filter(item => item !== ticketId);
                    localStorage.setItem('listas', JSON.stringify(listas));
                }
                localStorage.removeItem('ticket' + ticketId);
                
                let tickets_available = JSON.parse(localStorage.getItem('tickets_available'));
                tickets_available[ticketId-1] = 0;
                localStorage.setItem('tickets_available', JSON.stringify(tickets_available));

                const pedido_remove = document.getElementById('orden' + ticketId);
                pedido_remove.remove();

                plus = document.getElementById('tab-plus');
                plus.style.display = 'flex';

                localStorage.setItem('tabs', (localTabs-1));
                
                ticketExchange(activo);
            }
        }
    }   
}

function ticketArrows(ticketId,productId,productPrice,isAdd) {

    let tickets = JSON.parse(localStorage.getItem('ticket' + ticketId));
    let existingProduct = tickets.findIndex(ticket => ticket.productId === productId);
    
    if (isAdd) {

        tickets[existingProduct].productQuantity += 1;
        localStorage.setItem('ticket' + ticketId, JSON.stringify(tickets));
    
        const quantity = document.getElementById('quantity' + productId);
        let cantidad = quantity.textContent;
        quantity.textContent = parseInt(cantidad) + 1;
        const importe = document.getElementById('import' + productId);
        let importar = importe.textContent
        importar = importar.substring(2);
        importar = parseFloat(importar) + parseFloat(productPrice);
        importe.textContent = '$ ' + importar.toFixed(2);
        /*
        const subtotal = document.getElementById('subtotal');
        let total = subtotal.textContent;
        total = total.substring(2);
        total = parseFloat(total) + parseFloat(productPrice);
        subtotal.textContent = '$ ' + total.toFixed(2);
        */

    } else {

        if (tickets[existingProduct].productQuantity != 1) {

            tickets[existingProduct].productQuantity -= 1;
            localStorage.setItem('ticket' + ticketId, JSON.stringify(tickets));

            const quantity = document.getElementById('quantity' + productId);
            let cantidad = quantity.textContent;
            quantity.textContent = parseInt(cantidad) - 1;
            const importe = document.getElementById('import' + productId);
            let importar = importe.textContent
            importar = importar.substring(2);
            importar = parseFloat(importar) - parseFloat(productPrice);
            importe.textContent = '$ ' + importar.toFixed(2);
            /*
            const subtotal = document.getElementById('subtotal');
            let total = subtotal.textContent;
            total = total.substring(2);
            total = parseFloat(total) - parseFloat(productPrice);
            subtotal.textContent = '$ ' + total.toFixed(2);
            */
        } else {

            tickets.splice(existingProduct, 1);
            localStorage.setItem('ticket' + ticketId, JSON.stringify(tickets));

            const item = document.getElementById('item' + productId);
            item.remove();
            const sep = document.getElementById('separator' + productId);
            sep.remove();
            /*
            const subtotal = document.getElementById('subtotal');
            let total = subtotal.textContent;
            total = total.substring(2);
            total = parseFloat(total) - parseFloat(productPrice);
            subtotal.textContent = '$ ' + total.toFixed(2);
            */
        }
    }
    totalSet();
    totalGet();
}

function validateInput(input) {

    let value = input.value;

    // Remover cualquier carácter que no sea número o punto
    value = value.replace(/[^0-9.]/g, "");

    // Evitar ceros o puntos al inicio
    if (/^0|^\./.test(value)) {
        value = value.replace(/^0|^\./, "");
    }

    // Permitir solo un punto en la cadena
    const parts = value.split(".");
    if (parts.length > 2) {
        value = parts[0] + "." + parts[1];
    }

    // Limitar a dos decimales después del punto
    if (parts.length === 2) {
        parts[1] = parts[1].slice(0, 2);
        value = parts[0] + "." + parts[1];
    }

    // Limitar a tres cifras antes del punto
    if (parts[0].length > 3) {
        parts[0] = parts[0].slice(0, 3);
        value = parts.join(".");
    }

    input.value = value;

    const subtotal = document.getElementById('subtotal').textContent;
    let total = subtotal.substring(2);
    total = parseFloat(total);

    if (total <= value) {

        let cambio = value - total;
        document.getElementById('change').textContent = '$ ' + cambio.toFixed(2);
        document.getElementById('confirm').style.userSelect =  'auto';

    } else {
        document.getElementById('change').textContent = '$ 0.00';
        document.getElementById('confirm').style.userSelect =  'none';
    }

    const currency = document.getElementById('currencyType');
    currency.style.backgroundColor = 'red';
    currency.style.border = '1px solid red';
    currency.textContent = 'MXN';
}

function validateInput2(input) {

    let value = input.value;

    // Remover cualquier carácter que no sea número o punto
    value = value.replace(/[^0-9.]/g, "");

    // Evitar ceros o puntos al inicio
    if (/^0|^\./.test(value)) {
        value = value.replace(/^0|^\./, "");
    }

    // Permitir solo un punto en la cadena
    const parts = value.split(".");
    if (parts.length > 2) {
        value = parts[0] + "." + parts[1];
    }

    // Limitar a dos decimales después del punto
    if (parts.length === 2) {
        parts[1] = parts[1].slice(0, 2);
        value = parts[0] + "." + parts[1];
    }

    // Limitar a tres cifras antes del punto
    if (parts[0].length > 2) {
        parts[0] = parts[0].slice(0, 2);
        value = parts.join(".");
    }

    input.value = value;


    //const dolar = document.getElementById('dolarInput').value;
    let set = parseFloat(value) * 19;

    if (value == '') {
        document.getElementById('paymentInput').value = '';
    } else {
        document.getElementById('paymentInput').value = set.toFixed(2);
    }

    const subtotal = document.getElementById('subtotal').textContent;
    let total = subtotal.substring(2);
    total = parseFloat(total);

    const transfer = document.getElementById('paymentInput').value;
    let divisa = parseFloat(transfer)

    if (total <= divisa) {

        let cambio = divisa - total;
        document.getElementById('change').textContent = '$ ' + cambio.toFixed(2);
        document.getElementById('confirm').style.userSelect =  'auto';

    } else {
        document.getElementById('change').textContent = '$ 0.00';
        document.getElementById('confirm').style.userSelect =  'none';
    }
    
    const currency = document.getElementById('currencyType');
    currency.style.backgroundColor = 'green';
    currency.style.border = '1px solid green';
    currency.textContent = 'USD';
}

function paymentEnter(){

    const input = document.getElementById('ticketInput');
    const form = document.getElementById('form');
    const shower = document.getElementById('payment');
    const editar = document.getElementById('edit');

    const subtotal = document.getElementById('subtotal');
    const change = document.getElementById('changeText');

    let activo = parseInt(localStorage.getItem('activo'));

    const payment = JSON.parse(localStorage.getItem('payment'));

    let existingPayment = payment.findIndex(pay => pay.ticket == activo);
    console.log(existingPayment);
    
    if (existingPayment !== -1) {
        
        form.style.display = 'none';
        shower.textContent = '$ ' + parseFloat(input.value).toFixed(2);
        shower.style.display = 'block';
        editar.style.display = 'block';

        let entrada = parseFloat(input.value).toFixed(2);
        payment[existingPayment].cash = parseFloat(entrada);
        let total = subtotal.textContent;
        cambio = parseFloat(total.substring(2));
        cambio = entrada - cambio;
        payment[existingPayment].change = cambio;
        localStorage.setItem('payment', JSON.stringify(payment));
        change.textContent = '$ ' + cambio.toFixed(2);
    }


}

function paymentEdit(){

    const input = document.getElementById('ticketInput');
    const form = document.getElementById('form');
    const shower = document.getElementById('payment');
    const editar = document.getElementById('edit');

    const subtotal = document.getElementById('subtotal');
    const change = document.getElementById('changeText');

    form.style.display = 'flex';
    shower.textContent = '$ ' + parseFloat(input.value).toFixed(2);
    shower.style.display = 'none';
    editar.style.display = 'none';
    change.textContent = '';
}

// MODIFICA TOTAL DE TICKET ACTUAL
function totalSet(){

    let addition = 0;
    const active = localStorage.getItem('activo');
    const ticket = JSON.parse(localStorage.getItem('ticket' + active));
    ticket.forEach(element => {addition += element.productPrice*element.productQuantity;});

    const payment = JSON.parse(localStorage.getItem('payment'));
    
    for (let i = 0; i < payment.length; i++) {

        if (payment[i].ticket == active) {

            if (addition != 0) {
                payment[i].subtotal = addition;
            } else {
                payment[i].subtotal = null;
            }
            localStorage.setItem('payment', JSON.stringify(payment));
            //document.getElementById('subtotal').textContent = '$ ' + (payment[i].subtotal).toFixed(2);
        }
    }
}
// DESPLIEGA TOTAL DE TICKET ACTUAL
function totalGet(){

    const active = localStorage.getItem('activo');
    const payment = JSON.parse(localStorage.getItem('payment'));
    for (let i = 0; i < payment.length; i++) {
        if (payment[i].ticket == active) {
            if (payment[i].subtotal != null) {
                let total = parseFloat(payment[i].subtotal);
                document.getElementById('subtotal').textContent = '$ ' + total.toFixed(2);
            } else {
                document.getElementById('subtotal').textContent = '$ 0.00';
            }
        }
    }
}

document.getElementById('cobrar').addEventListener('click', function() {

    const totalPrint = document.getElementById('totalPrint');
    const blackScreen = document.getElementById('black-screen');
    const payScreen = document.getElementById('pay-screen');
    const paymentInput = document.getElementById('paymentInput');

    totalPrint.textContent = document.getElementById('subtotal').textContent;

    blackScreen.style.display = "block";
    payScreen.style.display = "flex";
    paymentInput.focus();
});

document.getElementById('cancelar').addEventListener('click', function() {

    const blackScreen = document.getElementById('black-screen');
    const payScreen = document.getElementById('pay-screen');
    const cambio = document.getElementById('change');
    const input = document.getElementById('paymentInput');
    const select = document.getElementById('opciones');
    const commission = document.getElementById('commission');

    blackScreen.style.display = "none";
    payScreen.style.display = "none";
    paymentInput.value = '';
    cambio.textContent = '$ 0.00';
    commission.textContent = '+ $ 0.00';
    select.value = 'efectivo';
});

document.getElementById('opciones').addEventListener('change', (event) => {

    const selectedValue = event.target.value;

    if (selectedValue == "efectivo") {
        document.getElementById('dolarContainer').style.display = 'flex';
        document.getElementById('changeContainer').style.display = 'flex';
    } else {
        document.getElementById('dolarContainer').style.display = 'none';
        document.getElementById('changeContainer').style.display = 'none';
    }

    if (selectedValue == "tarjeta") {

        const subtotal = document.getElementById('totalPrint').textContent;
        let st = subtotal.substring(2);
        let comm = Math.ceil(parseFloat(st) / 20);
        document.getElementById('commission').textContent = '+ $ ' + comm.toFixed(2);

        let tpc = parseFloat(st) + comm;
        document.getElementById('paymentInput').setAttribute('disabled', true);
        console.log(tpc);
        document.getElementById('paymentInput').value = tpc.toFixed(2);

        document.getElementById('comContainer').style.display = 'flex';

        const currency = document.getElementById('currencyType');
        currency.style.backgroundColor = 'red';
        currency.style.border = '1px solid red';
        currency.textContent = 'MXN';

    } else {
        document.getElementById('comContainer').style.display = 'none';
        document.getElementById('dolarInput').value = '';
    }

    if (selectedValue == "transferencia") {
        const total = document.getElementById('totalPrint').textContent;
        document.getElementById('paymentInput').setAttribute('disabled', true);
        document.getElementById('paymentInput').value = total.substring(2);
        
        const currency = document.getElementById('currencyType');
        currency.style.backgroundColor = 'red';
        currency.style.border = '1px solid red';
        currency.textContent = 'MXN';
        
    } else if (selectedValue != "tarjeta") {
        document.getElementById('paymentInput').removeAttribute('disabled');
        document.getElementById('paymentInput').value = '';
        document.getElementById('dolarInput').value = '';
    }
});

document.getElementById('confirm').addEventListener('click', function(event) {
    event.preventDefault();  // Asegurarse de pasar `event` como argumento

    const activo = localStorage.getItem('activo');
    if (!activo) {
        console.error("No se encontró el valor 'activo' en localStorage");
        return;
    }

    const ticket = JSON.parse(localStorage.getItem('ticket' + activo));
    if (!ticket) {
        console.error("No se encontró el ticket correspondiente en localStorage");
        return;
    }

    const tipo = document.getElementById('opciones').value;
    //let pago = parseFloat(payment.substring(2));
    if (!tipo) {
        console.error("El valor del tipo no es válido.");
        return;
    }

    const divisa = document.getElementById('currencyType').textContent;
    if (!divisa) {
        console.error("El valor de la divisa no es válido.");
        return;
    }

    const payment = document.getElementById('paymentInput').value;
    let pago = parseFloat(payment);
    if (isNaN(pago)) {
        console.error("El valor del pago no es válido.");
        return;
    }

    const ttl = document.getElementById('subtotal').textContent;
    let subtotal = parseFloat(ttl.substring(2));
    if (isNaN(subtotal)) {
        console.error("El valor total no es válido.");
        return;
    }

    const com = document.getElementById('commission').textContent;
    let comision = parseFloat(com.substring(4));
    if (isNaN(comision)) {
        console.error("El valor de la comisión no es válido.");
        return;
    }

    const change = document.getElementById('change').textContent;
    let cambio = parseFloat(change.substring(2));
    if (isNaN(cambio)) {
        console.error("El valor de cambio no es válido.");
        return;
    }

    const pay = [{
        paymentTypeTicket: tipo,
        currencyTicket: divisa,
        paymentTicket: pago,
        subtotalTicket: subtotal,
        commissionTicket: comision,
        totalTicket: subtotal + (comision || 0),
        changeTicket: cambio
    }];

    const pedido = JSON.stringify([ticket, pay]);  // Convertir el arreglo a JSON antes de enviarlo

    console.log(JSON.parse(pedido));

    fetch('ticket-query.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'  // Asegurarse de que el servidor acepte JSON
        },
        body: pedido  // Enviar directamente el cuerpo como JSON
    })
    .then(response => {

        if (response.ok) {

            const activo = localStorage.getItem('activo');
            ticketRemove(activo);

            Swal.fire({
                title: "¡PAGO COMPLETADO!",
                text: "¡La venta se realizo con éxito!",
                icon: "success"
            });
        }

        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.status} - ${response.statusText}`);
        }
        return response.text();  // O `response.json()` si el servidor devuelve JSON
    })
    .then(() => {

        const blackScreen = document.getElementById('black-screen');
        const payScreen = document.getElementById('pay-screen');
        const cambio = document.getElementById('change');
        const input = document.getElementById('paymentInput');
        const select = document.getElementById('opciones');
        const commission = document.getElementById('commission');
        document.getElementById('paymentInput').removeAttribute('disabled');

        blackScreen.style.display = "none";
        payScreen.style.display = "none";
        paymentInput.value = '';
        cambio.textContent = '$ 0.00';
        commission.textContent = '+ $ 0.00';
        select.value = 'efectivo';
    })
    .catch(error => {
        console.error('Error al realizar la solicitud:', error);
    });
});

</script>



<script>
    /*
    qz.websocket.connect().then(() => {
        return qz.printers.find();
    }).then((found) => {
        var config = qz.configs.create("XP-58");
        var data = [
            {
                type: 'html',        // Usamos el tipo HTML para todo el contenido
                format: 'plain',     // Formato de texto plano
                data: `
                    <h2>MISCELANEA ANA</h2>
                    <div>calle ficticia #1234, colonia alegría</div><br>
                    <div> 123 456 7890</div><br>
                    <div>01/01/2025 00:00 AM</div>
                    <div>Cajero: Héctor</div>
                    <div>Turno: #</div>
                    <div>Folio: 123</div><br>
                    <div style="display: grid; grid-template-columns: auto auto auto">
                        <div>Cantidad</div>
                        <div>Descripción</div>
                        <div>Precio</div>
                    </div>
                    <div style="display: grid; grid-template-columns: auto auto auto">
                        <div>1</div>
                        <div>galletas</div>
                        <div>$ 20.00</div>
                    </div>
                    <div style="display: grid; grid-template-columns: auto auto auto">
                        <div>2</div>
                        <div>frituras</div>
                        <div>$ 36.00</div>
                    </div><br><br>
                    <div>No. de productos: 3</div>
                    <div><strong>Total: $ 56.00</strong></div>
                    <div><strong>Pagó con: $ 60.00</strong></div>
                    <div><strong>Cambio: $ 4.00</strong></div><br><br>
                    <div>GRACIAS POR COMPRAR</div>
                    <div>nombre-pagina-web.com</div>
                    <img src="https://i.pinimg.com/1200x/db/39/10/db39101cbb8436f089016a86380e69d3.jpg" style="width:100%; height:auto;">
                ` // Todo el contenido (imagen + texto) dentro de un bloque HTML
            }
        ];
        return qz.print(config, data);
    }).catch((e) => {
        alert(e);
    });
    */
</script>