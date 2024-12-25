<div class="cool-navbar red" id="cool-navbar" style="z-index: 999;">
    <div class="start-search" id="start-search"></div>
    <a href="../billboard/billboard.php" class="cool-elements">
        <img src="../../images/house-door.svg">
    </a>
    <a href="../department/department.php" class="cool-elements">
        <img src="../../images/bag.svg">
    </a>
    <div class="dinamic-search" id="dinamic-search" onclick="bigger()">
        <div class="dinamic-search" id="dinamic-search" style="height: 50px;
            width: 50px;
            border-radius: 25px;
            border: 2px solid white;
            background-color: #fff;">

            <img id="search-image" src="../../images/search.svg">
        </div>
    </div>
    <form action="../../includes/search.php" method="GET" class="nav2-form">
        <div class="entry" id="entry">
            <input type="text" class="cool-search" name="cool-search" id="cool-search" placeholder="¿Qué Buscas?">
        </div>
    </form>
    <div class="dinamic-cancel" id="dinamic-cancel" onclick="clear()">
        <div class="dinamic-cancel2" id="dinamic-cancel2">
            <img class="cancel-cool-image" id="cancel-cool-image" src="../../images/x.svg">
        </div>
    </div>
    <div class="cool-elements">
        <a href="../cart/cart.php" class="cart-notification" style="height: 30px; width: 30px;">
            <div class="notification-number" style="
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                top: 0;
                right: 0;
                background-color: #fff;
                color: #e64747;
                height: 20px;
                width: 20px;
                border: 2px solid #e64747;
                border-radius: 50%;">
                    
            </div>
            <img class="notification-icon" src="../../images/cart.svg">
        </a>
</div>

    <?php if (isset($id) && isset($nombre) && isset($apellido) && isset($color)){ ?>

        <a href="../account/account.php?userid=<?= $id ?>"  class="cool-elements">
            <div class="profile-picture" style="overflow: hidden;
            height: 28px;
            width: 28px;
            border-radius: 50%;
            background-color: hsl(<?= $color ?>, 40%, 80%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: hsl(<?= $color ?>, 40%, 40%);
            font-size: 80%;">

            <?php 

            $firstname_letter = strtoupper(substr($nombre, 0, 1));
            $lastname_letter = strtoupper(substr($apellido, 0, 1));

            echo $firstname_letter.''.$lastname_letter;

            ?>

            </div>
        </a>

    <?php } else { ?>

        <a href="../login/login.php" class="cool-elements">
            <img src="../../images/person-circle.svg">
        </a>

    <?php } ?>

</div>

<script>

document.getElementById('dinamic-cancel').addEventListener('click', function () {
    const textInput = document.getElementById('cool-search');
    textInput.value = ''; // Borra el texto
    textInput.focus(); // Devuelve el foco al input
});


let bool_search = false;

// Función para agrandar el buscador
function bigger(){

    const coolnav = document.querySelector('.start-search');
    const search = document.querySelector('.dinamic-search');
    const entry = document.querySelector('.cool-search');
    const nav2Form = document.querySelector('.nav2-form');
    const cancel = document.querySelectorAll('.dinamic-cancel');
    const coolElements = document.querySelectorAll('.cool-elements');

    if (coolnav.classList.contains('big')) {

        coolnav.classList.add('small');
        search.classList.remove('move');
        entry.blur();
        nav2Form.style.display = "none";
        entry.classList.remove('show');
        coolnav.classList.remove('big');
        coolElements.forEach(element => {
            element.style.display = "flex";
        });
        cancel.forEach(element => {
            element.style.display = "none";
        });
        
        bool_search = false;
    }

    else {

        coolnav.classList.toggle('big', true);
        search.classList.toggle('move', true);
        entry.classList.toggle('show', true);
        nav2Form.style.display = "block";
        entry.focus();
        coolnav.classList.toggle('small', false);

        coolElements.forEach(element => {
            element.style.display = "none";
        });
        cancel.forEach(element => {
            element.style.display = "flex";
        });

        bool_search = true;
    }
}

function bigger2(){

    const coolnav = document.querySelector('.start-search');
    const search = document.querySelector('.dinamic-search');
    const entry = document.querySelector('.cool-search');
    const nav2Form = document.querySelector('.nav2-form');
    const cancel = document.querySelectorAll('.dinamic-cancel');
    const coolElements = document.querySelectorAll('.cool-elements');

    coolnav.classList.add('small');
    search.classList.remove('move');
    entry.blur();
    nav2Form.style.display = "none";
    entry.classList.remove('show');
    coolnav.classList.remove('big');
    coolElements.forEach(element => {
        element.style.display = "flex";
    });
    cancel.forEach(element => {
        element.style.display = "none";
    });
    
    bool_search = false;
}

document.addEventListener('click', function(event) {
    
    if (event.target.id !== 'entry'
            && event.target.id !== 'start-search'
            && event.target.id !== 'cool-search'
            && event.target.id !== 'dinamic-cancel'
            && event.target.id !== 'dinamic-cancel2'
            && event.target.id !== 'cancel-cool-image'
            && event.target.id !== 'cool-navbar'
            && event.target.id !== 'dinamic-search'
            && event.target.id !== 'search-image') {
        
        bigger2();
    }
});

document.addEventListener('touchstart', function(event) {
    
    if (event.target.id !== 'entry'
            && event.target.id !== 'start-search'
            && event.target.id !== 'cool-search'
            && event.target.id !== 'dinamic-cancel'
            && event.target.id !== 'dinamic-cancel2'
            && event.target.id !== 'cancel-cool-image'
            && event.target.id !== 'cool-navbar'
            && event.target.id !== 'dinamic-search'
            && event.target.id !== 'search-image') {
        
        bigger2();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    
    let productNumber = 0;
    const notificationNumber = document.querySelector('.notification-number');
    const carrito = JSON.parse(sessionStorage.getItem('carrito'));

    if (carrito && carrito.length > 0) {
        
        carrito.forEach(elemento => {
            
            productNumber += parseInt(elemento.productQuantity);
        });
        notificationNumber.innerHTML = productNumber;
    } else {

        notificationNumber.style.display = "none";
    }
});

</script>