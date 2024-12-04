<?php

include "../../includes/head.php";

session_start();

if(isset($_SESSION['nombre']) && isset($_SESSION['apellido'])){
    
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
} else { }

include "../../includes/dbconnect.php";

$query = "SELECT * FROM departments";
$dataset = mysqli_query($Conn,$query);

mysqli_close($Conn);

?>

<body>
    <?php include "../../includes/nav.php"; ?>
    <?php include "../../includes/mobile-detector.php"; ?>
    <?php if ($detect->isMobile()) { include "../../includes/nav2.php"; } ?>
    <?php include "../../includes/contact.php"; ?>

    
    <div class="billboard-container">

        <div class="billboard-titles">- - - - -&nbsp;&nbsp;&nbsp;&nbsp;Novedades&nbsp;&nbsp;&nbsp;&nbsp;- - - - -</div>
        
        <div class="box-news" id="box-news">

            <div class="gallery" id="gallery">
                <div class="slideshow" id="slideshow" style="background-color: blue;">
                    promo 1
                </div>
                <div class="slideshow" id="slideshow" style="background-color: green;">
                    promo 2
                </div>
                <div class="slideshow" id="slideshow" style="background-color: red;">
                    promo 3
                </div>
                <div class="slideshow" id="slideshow" style="background-color: yellow;">
                    promo 4
                </div>
                <div class="slideshow" id="slideshow" style="background-color: blue;">
                    promo 1
                </div>
            </div>

            <div class="dot-news">
            <img style="order: 1;" id="order" src="../../images/circle-fill.svg">
            <img style="order: 2;" id="order" src="../../images/circle.svg">
            <img style="order: 3;" id="order" src="../../images/circle.svg">
            <img style="order: 4;" id="order" src="../../images/circle.svg">
            </div>
            
            <div class="slide-left slide-center" id="left" onclick="slideLeft()">
                <img class="arrow" src="../../images/chevron-right.svg">
            </div> 

            <div class="slide-right slide-center" id="right" onclick="slideRight()">
                <img class="arrow" src="../../images/chevron-right.svg">
            </div>

        </div>
        
        <div class="billboard-titles">- - - - -&nbsp;&nbsp;&nbsp;&nbsp;Más Vendidos&nbsp;&nbsp;&nbsp;&nbsp;- - - - -</div>
        
        <div class="top-selling-box">
            <div class="sell-gallery">
                <div class="best-selled-products">adas</div>
                <div class="best-selled-products">adas</div>
                <div class="best-selled-products">adas</div>
                <div class="best-selled-products">adas</div>
                <div class="best-selled-products">adas</div>
                <div class="best-selled-products">adas</div>
                <div class="best-selled-products">adas</div>
                <div class="best-selled-products">adas</div>
                <div class="best-selled-products">adas</div>
                <div class="best-selled-products">adas</div>
            </div>
        </div>


        <div class="billboard-titles">- - - - -&nbsp;&nbsp;&nbsp;&nbsp;Departamentos&nbsp;&nbsp;&nbsp;&nbsp;- - - - -</div>
        
        <div class="box-billboard">

        <?php
        
            if (mysqli_num_rows($dataset) > 0) {

                while ($row = mysqli_fetch_assoc($dataset)) {

                    if ($row['department_enabled']) { ?>

                        <a href="../department/department.php?iddep=<?= $row['department_id'] ?>" class="box-dep">
                            <div><?= $row['department_name'] ?></div>
                            <div>
                                <img class="dep-image" src="../../images/departments/<?= $row['department_image'] ?>">
                            </div>
                        </a>

                    <?php }
                }
            } ?>

        </div>
    </div>

</body>
</html>

<script>
    
let number = 1;

const elements = document.querySelectorAll('[id="order"]');
const dotArray = Array.from(elements);

let lastScrollTop = 0;
let ticking = false;

function checkScrollPosition() {
  const coolnav = document.getElementById('cool-navbar');
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const documentHeight = document.documentElement.scrollHeight;
  const windowHeight = window.innerHeight;

  // Verifica si el usuario está cerca del final de la página
  if (documentHeight - scrollTop - windowHeight < 50) { // 50px es un umbral, ajusta según tus necesidades
    document.querySelector('.cool-navbar').classList.add('ocultar');
  } else {
    document.querySelector('.cool-navbar').classList.remove('ocultar');
  }

  // Solo ejecuta si hay un cambio en la posición de desplazamiento
  if (scrollTop !== lastScrollTop) {
    lastScrollTop = scrollTop;
    if (!ticking) {
      window.requestAnimationFrame(() => {
        console.log('La posición del scroll ha cambiado');
        ticking = false;
      });
      ticking = true;
    }
  }
}

// Llama a la función al cargar la página para iniciar la verificación
function startChecking() {
  checkScrollPosition();
  requestAnimationFrame(startChecking);
}

// Inicia la verificación de posición al cargar la página
startChecking();


window.addEventListener('DOMContentLoaded', function () {
    
    var source = document.getElementById('box-news');
    var gallery = document.getElementById('gallery');
    var targets = document.querySelectorAll('.slideshow'); // Selecciona todos los elementos con la clase 'slideshow'

    targets.forEach(function(target) {
        target.style.width = source.offsetWidth + 'px'; // Aplica el ancho del 'source' a cada 'target'
    });
});

window.addEventListener('resize', function () {

    var source = document.getElementById('box-news');
    var gallery = document.getElementById('gallery');
    var targets = document.querySelectorAll('.slideshow'); // Selecciona todos los elementos con la clase 'slideshow'

    targets.forEach(function(target) {

        var distance = source.offsetWidth*(number-1);
        gallery.style.transition = 'transform 0.0s ease';
        gallery.style.transform = `translateX(-${distance}px)`;

        target.style.width = source.offsetWidth + 'px';
    });
});

function slideRight(){

    var arrowClick = "right";

    var box_news = document.getElementById('box-news');
    var gallery = document.getElementById('gallery');
    var arrowLeft = document.getElementById('left');
    var arrowRight = document.getElementById('right');

    arrowLeft.style.pointerEvents = 'none';
    arrowRight.style.pointerEvents = 'none';
    
    if (number == 5) {
            
        gallery.style.transition = 'transform 0.0s ease';
        gallery.style.transform = `translateX(0px)`;
        number = 1;
    }

    if (gallery && box_news  && number <= 5) {
        
        var distance = box_news.offsetWidth;

        var currentTransform = window.getComputedStyle(gallery).transform;
        var currentX = 0;

        if (currentTransform !== 'none') {
            currentX = parseFloat(currentTransform.split(',')[4]);
        }

        var newX = currentX - distance;

        gallery.style.transition = 'transform 0.5s ease';
        gallery.style.transform = `translateX(${newX}px)`;
    }

    setTimeout(() => {

        arrowLeft.style.pointerEvents = 'auto';
        arrowRight.style.pointerEvents = 'auto';
    }, 501);

    number++;

    let change = false;

    dotArray.forEach((element, i) => {

        const computedStyle = window.getComputedStyle(element);
        const elementOrder = parseInt(computedStyle.order) || 0; 

        if (elementOrder == number) {

            const firstElement = dotArray[0];
            const firstComputedStyle = window.getComputedStyle(firstElement);
            const firstOrder = parseInt(firstComputedStyle.order) || 0;

            element.style.order = firstOrder;
            firstElement.style.order = elementOrder;
        }

        if(number == 5) {
            
            element.style.order = i+1;
        }
    });
}

function slideLeft(){

    var box_news = document.getElementById('box-news');
    var gallery = document.getElementById('gallery');
    var arrowLeft = document.getElementById('left');
    var arrowRight = document.getElementById('right');

    arrowLeft.style.pointerEvents = 'none';
    arrowRight.style.pointerEvents = 'none';
    
    if (number == 1) {
        
        var distance = box_news.offsetWidth*4;
        gallery.style.transition = 'transform 0.0s ease';
        gallery.style.transform = `translateX(-${distance}px)`;
        number = 5;
    }

    if (gallery && box_news  && number <= 5) {
        
        var distance = box_news.offsetWidth;

        var currentTransform = window.getComputedStyle(gallery).transform;
        var currentX = 0;

        if (currentTransform !== 'none') {
            currentX = parseFloat(currentTransform.split(',')[4]);
        }

        var newX = currentX + distance;

        gallery.style.transition = 'transform 0.5s ease';
        gallery.style.transform = `translateX(${newX}px)`;
        
        
    }

    setTimeout(() => {

        arrowLeft.style.pointerEvents = 'auto';
        arrowRight.style.pointerEvents = 'auto';
    }, 501);
    
    number--;

    let change = false;

    dotArray.forEach((element, i) => {

        const computedStyle = window.getComputedStyle(element);
        const elementOrder = parseInt(computedStyle.order) || 0; 

        if (elementOrder == number) {

            const firstElement = dotArray[0];
            const firstComputedStyle = window.getComputedStyle(firstElement);
            const firstOrder = parseInt(firstComputedStyle.order) || 0;

            element.style.order = firstOrder;
            firstElement.style.order = elementOrder;
        }

        if(number == 5) {
            
            element.style.order = i+1;
        }
    });
}

</script>