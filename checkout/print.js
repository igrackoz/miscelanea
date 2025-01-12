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