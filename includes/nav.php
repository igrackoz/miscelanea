<div class="bar sticky-top">
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

            <div class="user-element" id="menu-element">
                <div id="menu-img">
                    <img style="height: 40px; width: 40px; user-select: none; pointer-events: none;"  src="../../images/user_menu.png">
                </div>
                <div style="font-weight: bold;" id="menu-name">
                    <?= $nombre ?>
                </div>
            </div>

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
        <div class="menu-element" id="menu-element">
            <div id="menu-img">
                <img class="menu-icon" src="../../images/archive-fill.svg">
            </div>
            Departamentos
        </div>
        <div class="menu-element" id="menu-element">
            <div id="menu-img">
                <img class="menu-icon" src="../../images/gear.svg">
            </div>
            Servicios
        </div>

        <?php if (isset($nombre) && isset($apellido)){ ?>

            <div class="menu-element" id="menu-element">
                <div id="menu-img">
                    <img class="menu-icon" src="../../images/heart.svg">
                </div>
                Favoritos
            </div>
            <div class="menu-element" id="menu-element">
                <div id="menu-img">
                    <img class="menu-icon" src="../../images/cart-fill.svg">
                </div>
                Carrito
            </div>
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
    <div class="search">
        <input type="text" style="height: 60px; width: 90%; padding-left: 18px; padding-bottom: 5px; border: none; border-radius: 30px;" placeholder="¿Qué buscas?">
    </div>
    <div class="space">
    </div>
    <div class="login">

        <?php if (isset($nombre) && isset($apellido)){ ?>

            <div class="box-login" style="color:white;" onclick="toggleAccordion(event)">
                <img class="img" src="../../images/user.png">
                <p class="log">
                    <?php 

                        $nospaces = str_replace(' ', '', $nombre);
                        $size = strlen($nospaces);

                        if($size > 10){

                            $resize = substr($nombre, 0, 10);
                            echo $resize."...";
                        }
                    
                     ?></p>
                <p class="reg"> Cuenta </p>
                <div class="arrow">
                    <img src="../../images/down_arrow.svg" id="arrow">
                </div>
            </div>
            <a href="../../includes/logout.php" class="accordion-content">
                <div style="color: white; padding:0; margin:0;">
                    <img src="../../images/box-arrow-left.svg">
                    &nbsp;
                    <strong> Salir </strong>
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

    <?php if (isset($nombre) && isset($apellido)){ ?>
        
        <div class="cart" onclick="toggleAccordion2(event)">
            <img style="height: 30px; width: 30px; user-select: none; pointer-events: none;" src="../../images/shopping-cart.png">
        </div>

    <?php } else { ?>

        <a href="../login/login.php" class="cart">
            <img style="height: 30px; width: 30px; user-select: none; pointer-events: none;" src="../../images/shopping-cart.png">
        </a>

    <?php } ?>
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
    <div class="zoom-panel" id="zoom-panel">
        <input type="text" id="zoom-search" style="height: 80%; width: 98%; padding-left: 18px; padding-bottom: 5px; border: none; border-radius: 30px;" placeholder="¿Qué buscas?">
        </div>
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

function toggleAccordion(event) {
    const accordionContent = document.querySelector('.accordion-content');
    const isOpen = accordionContent.classList.contains('open');
    var arrow = document.getElementById("arrow");

    // Cierra cualquier acordeón abierto
    document.querySelectorAll('.accordion-content.open').forEach(content => {
        content.classList.remove('open');
    });

    // Si no estaba abierto, abrir el actual
    if (!isOpen) {
        accordionContent.classList.add('open');
        /*arrow.style.transform = 'rotate(180deg)';*/
    } else {
        
        /*arrow.style.transform = 'rotateX(360deg)';*/
    }

    // Detener propagación para que no cierre inmediatamente
    event.stopPropagation();
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
            && event.target.id !== 'menu-nane'
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