<?php

$bp = "../../includes/";
include $bp."user-validation.php";
include $bp."head.php";
include $bp."dbconnect.php";

$query = "SELECT * FROM departments";
$dataset = mysqli_query($Conn,$query);

mysqli_close($Conn);

?>

<body>
    <?php
        include $bp."loading.php";
        include $bp."mobile-detector.php";
        include $detect->isTablet() || $detect->isMobile() ? $bp . "nav2.php" : $bp . "nav.php";
        $file_to_include = $detect->isTablet() || $detect->isMobile() ? "" : $bp . "contact.php";
        if (trim($file_to_include) !== "") {
            include $file_to_include;
        }
        include "../../dev/dev.php";
    ?>

    <div class="billboard-container">
        <div style="padding-top: 50px; margin-bottom: 20px; display: flex; justify-content: center; align-items: center;">
            <img style="height: 100px; width: 150px; filter: brightness(0) saturate(100%) invert(38%) sepia(1%) saturate(1225%) hue-rotate(323deg) brightness(91%) contrast(93%);" src="../../images/logo2.svg" alt="">
        </div>
        <div style="margin-bottom: 50px; display: flex; justify-content: center; align-items: center; font-size: 30px;">DEPARTAMENTOS</div>

        <div class="box-billboard">

            <?php
            
                if (mysqli_num_rows($dataset) > 0) {

                    while ($row = mysqli_fetch_assoc($dataset)) {

                        if ($row['department_enabled']) { ?>

                            <a href="../segment/segment.php?iddep=<?= $row['department_id'] ?>" class="box-dep">
                                <div><?= $row['department_name'] ?></div>
                                <div>
                                    <img class="dep-image dep-image-charge<?= $row['department_id'] ?>" src="../../images/box.svg" data-original="../../images/departments/<?= $row['department_image'] ?>" style="opacity: 1; transition: opacity 0.3s;">
                                </div>
                            </a>
                            <script>
                                const images<?= $row['department_id'] ?> = document.querySelectorAll('.dep-image-charge<?= $row['department_id'] ?>');

                                images<?= $row['department_id'] ?>.forEach(image => {
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
                            </script>

                        <?php }
                    }
                } ?>

            </div>
        </div>
    </div>
    <?php include '../../includes/footer-image.php'; ?>
</body>
</html>
