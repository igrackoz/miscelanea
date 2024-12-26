<div class="bar sticky-top red">
    <div class="menu-panel" id="menu-panel">
        <div class="close-menu" id="close-menu">
            <img src="../../images/arrow-left-short.svg">
        </div>
        <div class="logo-menu" id="logo-menu">
            <img style="height: 50px; width: 50px; user-select: none; pointer-events: none;" src="../../images/logo.jpg">
        </div>
        <div class="menu-separator" id="menu-separator"></div>
        <div class="hr" id="hr"></div>

        <?php if (isset($nombre) && isset($apellido)){ ?>

            <a href="../account/account.php?userid=<?= $id ?>" class="user-element" id="menu-element">
                <div id="menu-img">
                    <div class="profile-pciture" id="letter-image" style="overflow: hidden;
                        height: 40px;
                        width: 40px;
                        border-radius: 50%;
                        background-color: hsl(<?= $color ?>, 40%, 80%);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: bold;
                        color: hsl(<?= $color ?>, 40%, 40%);
                        font-size: 100%;">

                        <?php 

                        $firstname_letter = strtoupper(substr($nombre, 0, 1));
                        $lastname_letter = strtoupper(substr($apellido, 0, 1));

                        echo $firstname_letter.''.$lastname_letter;
                        
                        ?>

                    </div>
                </div>
                <div style="font-weight: bold;" id="menu-name">
                    <?= $nombre ?>
                </div>
            </a>

        <?php } else { ?>

            <a href="../login/login.php" class="user-element" id="menu-element">
                <div id="menu-img">
                    <img style="height: 40px; width: 40px; user-select: none; pointer-events: none;"  src="../../images/user_menu.png">
                </div>
                <div class="user-element2" id="menu-element">
                    Iniciar Sesión
                </div>
            </a>

        <?php } ?>

        <div class="hr" id="hr"></div>
        <br>
        <a href="../department/department.php" class="menu-element" id="menu-element">
            <div id="menu-img">
                <img class="menu-icon" src="../../images/archive-fill.svg">
            </div>
            Departamentos
        </a>
        <a href="../services/services.php" class="menu-element" id="menu-element">
            <div id="menu-img">
                <img class="menu-icon" src="../../images/gear.svg">
            </div>
            Servicios
        </a>

        <?php if (isset($nombre) && isset($apellido)){ ?>

            <div class="menu-element" id="menu-element">
                <div id="menu-img">
                    <img class="menu-icon" src="../../images/heart-menu.svg">
                </div>
                Favoritos
            </div>
            <a href="../cart/cart.php" class="menu-element" id="menu-element">
                <div id="menu-img">
                    <img class="menu-icon" src="../../images/cart-fill.svg">
                </div>
                Carrito
            </a>
            <a href="../../includes/logout.php">
                <div class="menu-element" id="menu-element" style="color:#e8104a;">
                    <div id="menu-img">
                        <img class="menu-icon" src="../../images/box-arrow-left2.svg">
                    </div>
                    Cerrar Sesión
                </div>
            </a>
        
        <?php } ?>

    </div>
    <div class="menu" id="menu" onclick="toggleAccordionMenu(event)">
        <img style="height: 30px; width: 30px; user-select: none;" src="../../images/menu.png">
    </div>
    <a href="../billboard/billboard.php" class="brand col text-center">
        <img style="height: 40px; width: 45px; user-select: none; pointer-events: none;" src="../../images/logo.png">
    </a>
    <a href="../billboard/billboard.php" class="title">
        <div class="text">
            <h1 style=" font-size: 19px; font-weight: bold; color:white;">Miscelana</h1>
        </div>
    </a>
        <form action="../../includes/search.php" method="GET" class="search">
            <input type="text" name="cool-search" style="height: 60px; width: 90%; padding-left: 18px; padding-bottom: 5px; border: none; border-radius: 30px;" placeholder="¿Qué buscas?">
        </form>
    <div class="space">
    </div>
    <div class="login">

        <?php if (isset($id) && isset($nombre) && isset($apellido) && isset($color)){ ?>

            <a href="../account/account.php?userid=<?= $id ?>" class="box-login" style="color:white;" onclick="toggleAccordion(event)">

                <div class="profile-pciture" style="overflow: hidden;
                    height: 40px;
                    width: 40px;
                    border-radius: 50%;
                    background-color: hsl(<?= $color ?>, 40%, 80%);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: bold;
                    color: hsl(<?= $color ?>, 40%, 40%);
                    font-size: 100%;">

                    <?php 

                    $firstname_letter = strtoupper(substr($nombre, 0, 1));
                    $lastname_letter = strtoupper(substr($apellido, 0, 1));

                    echo $firstname_letter.''.$lastname_letter;
                    
                    ?>

                </div>
                
                <p class="log">

                <?php 

                    /*$nospaces = str_replace(' ', '', $nombre);*/
                    $size = strlen($nombre);

                    if($size > 10){

                        $resize = substr($nombre, 0, 10);
                        echo $resize."...";
                    } else {

                        echo $nombre;
                    }

                ?>
                    
                </p>
                
                <p class="reg"> Cuenta </p>
                <div class="arrow">
                    <img src="../../images/down_arrow.svg" id="arrow">
                </div>
            </a>

        <?php } else { ?>

            <a href="../login/login.php" class="box-login" style="color:white;">
                <img class="img" src="../../images/user.png">
                <p class="log"> Iniciar Sesión </p>
                <p class="reg"> Registrarse </p>
            </a>

        <?php } ?>

    </div>
    <div class="cart" onclick="toggleAccordion2(event)">
        <img style="height: 30px; width: 30px; user-select: none; pointer-events: none;" src="../../images/shopping-cart.png">
    </div>
    <div class="cover" id="cover">
          
    </div>
    <div class="cart-panel" id="cart-panel"> 
        <div class="cancel-button" id="cancel-button">
            <img src="../../images/equis.svg">
        </div>
    </div>

    <div class="zoom" id="zoom" onclick="toggleAccordionSearch(event)">
        <img style="height: 25px; width: 25px; user-select: none; pointer-events: none;" src="../../images/zoom.png">
    </div>
    <form action="../../includes/search.php" method="GET" class="zoom-panel" id="zoom-panel">
        <input type="text" id="zoom-search" name="cool-search" style="height: 80%; width: 98%; padding-left: 18px; padding-bottom: 5px; border: none; border-radius: 30px;" placeholder="¿Qué buscas?">
    </form>
</div>

<script>

function toggleAccordionMenu(event) {
    const accordionContent = document.querySelector('.menu-panel');
    const accordionContent2 = document.querySelector('.cover');
    const isOpen = accordionContent.classList.contains('open');

    // Cierra cualquier acordeón abierto
    document.querySelectorAll('.menu-panel.open').forEach(content => {
        content.classList.remove('open');
    });

    document.querySelectorAll('.cover.open').forEach(content => {
        content.classList.remove('open');
    });

    // Si no estaba abierto, abrir el actual
    if (!isOpen) {
        accordionContent.classList.add('open');
        accordionContent2.classList.add('open');
    }

    // Detener propagación para evitar que otros eventos interfieran
    if (event) {
        event.stopPropagation();
    }
}

function toggleAccordionSearch(event) {
    const accordionContent = document.querySelector('.zoom-panel');
    const accordionContent2 = document.querySelector('.cover');
    const ZoomSearch = document.getElementById('zoom-search');
    const isOpen = accordionContent.classList.contains('open');

    // Cierra cualquier acordeón abierto
    document.querySelectorAll('.zoom-panel.open').forEach(content => {
        content.classList.remove('open');
    });

    document.querySelectorAll('.cover.open').forEach(content => {
        content.classList.remove('open');
    });

    // Si no estaba abierto, abrir el actual
    if (!isOpen) {
        accordionContent.classList.add('open');
        accordionContent2.classList.add('open');
        ZoomSearch.focus();
    }

    // Detener propagación para evitar que otros eventos interfieran
    if (event) {
        event.stopPropagation();
    }
}

function toggleAccordion2(event) {
    const accordionContent = document.querySelector('.cart-panel');
    const accordionContent2 = document.querySelector('.cover');
    const isOpen = accordionContent.classList.contains('open');

    // Cierra cualquier acordeón abierto
    document.querySelectorAll('.cart-panel.open').forEach(content => {
        content.classList.remove('open');
    });

    document.querySelectorAll('.cover.open').forEach(content => {
        content.classList.remove('open');
    });

    // Si no estaba abierto, abrir el actual
    if (!isOpen) {
        accordionContent.classList.add('open');
        accordionContent2.classList.add('open');
    }

    // Detener propagación para evitar que otros eventos interfieran
    if (event) {
        event.stopPropagation();
    }
}

document.addEventListener('click', () => {
        
        document.querySelectorAll('.accordion-content.open').forEach(content => {
            content.classList.remove('open');
        });

        if (event.target.id !== 'cart-panel'
            && event.target.id !== 'menu-panel'
            && event.target.id !== 'zoom-panel'
            && event.target.id !== 'zoom-search'
            && event.target.id !== 'logo-menu'
            && event.target.id !== 'menu-search'
            && event.target.id !== 'menu-separator'
            && event.target.id !== 'menu-img'
            && event.target.id !== 'menu-name'
            && event.target.id !== 'letter-image'
            && event.target.id !== 'hr'
            && event.target.id !== 'menu-element') {
        
            document.querySelectorAll('.cart-panel.open').forEach(content => {
                content.classList.remove('open');
            });
            
            document.querySelectorAll('.cover.open').forEach(content => {
                content.classList.remove('open');
            });

            document.querySelectorAll('.menu-panel.open').forEach(content => {
                content.classList.remove('open');
            });

            document.querySelectorAll('.zoom-panel.open').forEach(content => {
                content.classList.remove('open');
            });

            document.querySelectorAll('.zoom-search.open').forEach(content => {
                ZoomSearch.blur();
            });
        }
});

window.addEventListener('resize', () => {

    if (window.innerWidth > 600) {

        document.querySelectorAll('.menu-panel.open').forEach(content => {
            content.classList.remove('open');
        });

        document.querySelectorAll('.zoom-panel.open').forEach(content => {
            content.classList.remove('open');
        });

        document.querySelectorAll('.cover.open').forEach(content => {
            content.classList.remove('open');
        });
    }

    if (window.innerWidth < 600) {

        document.querySelectorAll('.cart-panel.open').forEach(content => {
            content.classList.remove('open');
        });
    }
});

</script>