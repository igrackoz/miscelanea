<a href="https://api.whatsapp.com/send?phone=528781167110" target="_blank">
    <div class="btn-contact" id="contact" onmouseenter="contact_hoverin()" onmouseleave="contact_hoverout()">
        <img class="logo-contact" id="logo" src="../../images/wa_logo.svg">
    </div>
</a>
<div class="hover-popup" id="popup">Contáctanos por WhatsApp</strong></div>

<script>

function contact_hoverin() {
    if (window.innerWidth <= 600) return;
    
    var contact = document.getElementById("contact");
    var logo = document.getElementById("logo");
    var popup = document.getElementById("popup");
    
    contact.style.backgroundColor = "rgb(255,255,255)";
    logo.style.filter = "brightness(0) saturate(100%) invert(73%) sepia(57%) saturate(2828%) hue-rotate(97deg) brightness(96%) contrast(101%)";
    popup.style.width = "100mm";
    popup.style.opacity = 1;
    popup.style.fontSize = "18px";
}

function contact_hoverout() {
    if (window.innerWidth <= 600) return;
    
    var contact = document.getElementById("contact");
    var logo = document.getElementById("logo");
    
    contact.style.backgroundColor = "rgb(0,230,118)";
    logo.style.filter = "brightness(0) saturate(100%) invert(97%) sepia(95%) saturate(19%) hue-rotate(163deg) brightness(104%) contrast(101%)";
    popup.style.width = "18mm";
    popup.style.opacity = 0;
    popup.style.fontSize = "0px";
}

</script>