<div id="black-screen" style="
    position: fixed;
    height: 100vh;
    width: 100vw;
    background-color: #000;
    display: none;
    align-items: center;
    justify-content: center;
    opacity: 0.5;
    z-index: 5000;">
</div>
<div id="pay-screen" style="
    position: fixed;
    height: 100vh;
    width: 100vw;
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 5001;">
    <div style="
    position: relative;
        background-color: #fff;
        height: 60%;
        width: 70%;
        border-radius: 15px;">
        <div id="cancelar" style="
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
            position: absolute;
            top: 0;
            right: 0;
            height: 50px;
            width: 50px;">
            <img src="payment-cancel.svg">
        </div>

        <div id="dolarContainer" style="
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px;
            font-size: 36px;
            position: absolute;
            bottom: 0;
            left: 0;">
            <label>USD:</label>&nbsp;&nbsp;
            <div style="display: flex; align-items: center; justify-content: center;">
                <input type="text" oninput="validateInput2(this)" id="dolarInput" style="font-size: 36px; width: 160px;">
            </div>
        </div>

        <div id="total" style="
            margin: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: auto;
            height: 150px;
            font-size: 100px;
            color: red;">
            <div id="totalPrint">
            $ 0.00
            </div>
        </div>
        <div id="comContainer" style="display: none; justify-content: center; font-size: 36px; color: green;">
            <label>Comisión:</label>&nbsp;&nbsp;&nbsp;
            <div id="commission" style="display: flex; align-items: center; justify-content: center;">+ $ 0.00</div>
            <div style="width: 410px;"></div>
        </div>
        <div style="display: flex; justify-content: center; font-size: 36px;">
            <label>Paga con:</label>&nbsp;&nbsp;&nbsp;
            <div style="display: flex; align-items: center; justify-content: center;">
                <input type="text" oninput="validateInput(this)" id="paymentInput" style="font-size: 36px; height: 50px; border-radius: 15px 0px 0px 15px; width: 300px;">
                <div id="currencyType" style=" border: 1px solid red;display: flex; align-items: center; justify-content: center; height: 50px; width: 80px; background-color: red; font-size: 24px; font-family: calibri; color: #fff; border-radius: 0px 15px 15px 0px; font-weight: bold;">MXN</div>
            </div>
            <div style="height: 100%; wdith: 80px;">
                <select id="opciones" name="opciones" style="
                    height: 50px; margin-left: 20px; font-size: 22px;">
                    <option value="efectivo" selected>EFECTIVO</option>
                    <option value="tarjeta">TARJETA</option>
                    <option value="transferencia">TRANSFERENCIA</option>
                </select>
            </div>
        </div>
        <div id="changeContainer" style="display: flex; justify-content: center; font-size: 36px;">
            <label>Cambio:</label>&nbsp;&nbsp;&nbsp;
            <div id="change" style="display: flex; align-items: center; justify-content: center;">
                $ 0.00
            </div>
            <div style="width: 430px;"></div>
        </div>
        <div style="height: 150px; width: auto; display: flex; justify-content: center; align-items: center;">
            <div id="confirm" style="
                display: flex;
                align-items: center;
                justify-content: center;
                height: 80px;
                width: 300px;
                background-color: red;
                border-radius: 10px;
                color: #fff;
                font-family: calibri;
                font-size: 24px;
                font-weight: bold;">
                <div>CONFIRMAR</div>
            </div>
        </div>
    </div>

</div>
