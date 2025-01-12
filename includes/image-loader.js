function imageLoader(images){
    
    images.forEach(image => {

        // Guardar el src original
        const originalSrc = image.getAttribute('data-original');

        // Crear una nueva instancia para cargar la imagen original
        const tempImg = new Image();
        tempImg.src = originalSrc;

        tempImg.onload = function () {
            // Ocultar temporalmente la imagen de carga
            image.style.transition = 'none'; // Quitar transición para ocultar inmediatamente
            image.style.opacity = '0';

            // Cambiar el src a la imagen original
            setTimeout(() => {
                image.src = originalSrc;

                // Aplicar el fade-in después de actualizar el src
                image.style.transition = 'opacity 0.5s';
                image.style.opacity = '1';
            }, 50); // Pequeño retraso para asegurar el cambio de src
        };

        tempImg.onerror = function () {
            // En caso de error, mostrar una imagen alternativa
            image.src = '../../images/error.svg';
            image.style.opacity = '1';
        };
    });
    
}