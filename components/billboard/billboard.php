<?php

include "../../includes/paths.php";
include $bp."user-validation.php";
include $bp."head.php";
include $bp."dbconnect.php";

$query = "SELECT * FROM departments";
$dataset = mysqli_query($Conn,$query);

mysqli_close($Conn);

?>

<body>
    <?php
        include $bp."mobile-detector.php";
        include $detect->isTablet() || $detect->isMobile() ? $bp . "nav2.php" : $bp . "nav.php";
        include $bp."contact.php";
        include "../../dev/dev.php";
    ?>
    
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

                        <a href="../segment/segment.php?iddep=<?= $row['department_id'] ?>" class="box-dep">
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
    
    resetInterval();
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

    resetInterval();
}

let interval_id;

function startInterval() {

    interval_id = setInterval(slideRight, 6000);
}

function resetInterval() {

    if (interval_id) {
        clearInterval(interval_id);
    }

    startInterval();
}

startInterval();



window.addEventListener('DOMContentLoaded', function () {

    const urlParams = new URLSearchParams(window.location.search);
    
    let user = urlParams.get('user'); 

    if (user) {
        sessionStorage.setItem('user', user);
    }
});


</script>