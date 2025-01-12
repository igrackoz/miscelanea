<!-- imagen en pie de página  -->
<style>

@keyframes bounce {
    0% {
        transform: scale(1.35);
    }
    12% {
        transform: scale(0.7);
    }
    25% {
        transform: scale(1.25);
    }
    37% {
        transform: scale(0.8);
    }
    62% {
        transform: scale(1.15);
    }
    75% {
        transform: scale(0.9);
    }
    88% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

.bouncing {
    animation: bounce 0.5s ease;
}

</style>

<div style="
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 500px;
    aspect-ratio: 1 / 1;">
    <img id="bounce" style="height: 70%; width: auto; aspect-ratio: 1 / 1;" src="../../images/christmas_tree.png">
</div>

<script>

const bounceElement = document.getElementById('bounce');
const audio = new Audio('../../sounds/bubbles2.mp3');

bounceElement.addEventListener('mousedown', () => {

    // Reproducir el sonido
    audio.currentTime = 0; // Reinicia el audio
    audio.play();

    // Remover y añadir la clase para reiniciar la animación
    bounceElement.classList.remove('bouncing');
    setTimeout(() => {
        bounceElement.classList.add('bouncing');
    }, 10);
});

</script>