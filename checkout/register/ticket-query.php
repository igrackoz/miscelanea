<?php
include "../../includes/dbconnect.php";
/*
$pedido = [
    [
        [
            "productId" => 1398,
            "productDescription" => "Fuze Tea Té Negro Durazno 600ml",
            "productPrice" => 19,
            "productQuantity" => 1
        ]
    ],
    [
        [
            "paymentTypeTicket" => "efectivo",
            "currencyTicket" => "mxn",
            "paymentTicket" => 20,
            "subtotalTicket" => 19,
            "commissionTicket" => 0,
            "totalTicket" => 19,
            "changeTicket" => 1
        ]
    ]
];
*/
$pedido = json_decode(file_get_contents('php://input'), true);

if ($pedido) {
    // Acceder al arreglo de ticket (el segundo en el arreglo principal)
    $ticket = $pedido[1][0];

    // Extraer los valores del ticket
    $type = $ticket['paymentTypeTicket'];
    $currency = $ticket['currencyTicket'];
    $payment = $ticket['paymentTicket'];
    $subtotal = $ticket['subtotalTicket'];
    $comm = $ticket['commissionTicket'];
    $total = $ticket['totalTicket'];
    $change = $ticket['changeTicket'];

    // Preparar la consulta SQL
    $query = "INSERT INTO tickets (
        ticket_date,
        ticket_payment_method,
        ticket_currency,
        ticket_payment,
        ticket_subtotal,
        ticket_commission,
        ticket_total,
        ticket_change)
    VALUES (NOW(),?,?,?,?,?,?,?)";

    $stmt = mysqli_prepare($Conn, $query);
    mysqli_stmt_bind_param($stmt, "ssddddd", $type, $currency, $payment, $subtotal, $comm, $total, $change);
    mysqli_stmt_execute($stmt);
    $ticket_id = mysqli_insert_id($Conn);

    for ($i=0; $i < count($pedido[0]); $i++) { 
        
        $productos = $pedido[0][$i];

        $price = $productos['productPrice'];
        $quantity = $productos['productQuantity'];
        $id = $productos['productId'];
        

        $query = "INSERT INTO ticket_products (
            ticket_product_price,
            ticket_product_quantity,
            product_id,
            ticket_id)
        VALUES (?,?,?,?)";
    
        $stmt = mysqli_prepare($Conn, $query);
        mysqli_stmt_bind_param($stmt, "diii", $price, $quantity, $id, $ticket_id);
        mysqli_stmt_execute($stmt);
    }
}

/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['data'])) {
*/
/*
        $array = json_decode($_POST['data'], true);

        $ticket = $array['currencyTicket'][2];  // Acceder al primer elemento del arreglo 'ticket'

        // Extraer los valores
        $ticketId = $ticket['ticket'];
        $ticketType = $ticket['type'];
        $currency = $ticket['currency'];
        $subtotal = $ticket['subtotal'];

        // Acceder al primer elemento del arreglo 'pedido'
        $pedido = $array['pedido'][0];  // Acceder al primer elemento del arreglo 'pedido'

        // Extraer los valores del pedido
        $paymentTicket = $pedido['paymentTicket'];
        $totalTicket = $pedido['totalTicket'];
        $changeTicket = $pedido['changeTicket'];
        $currencyTicket = $pedido['currencyTicket'];
        $paymentTypeTicket = $pedido['paymentTypeTicket'];
        $commission = $pedido['commission'];

        $query = "INSERT INTO tickets (
            ticket_date,
            ticket_payment_method,
            ticket_exact_exchange,
            ticket_payment,
            ticket_total)
                    VALUES (NOW(),?,0,?,?)";
        $stmt = mysqli_prepare($Conn, $query);
        mysqli_stmt_bind_param($stmt, "sssd", $paymentTypeTicket, $paymentTicket, $totalTicket);
        mysqli_stmt_execute($stmt);

*/
        /*
        $query = "INSERT INTO ticket_products";
        $dataset = mysqli_query($Conn, $query);
        */
        // inserción de datos

/*
    }
}*/