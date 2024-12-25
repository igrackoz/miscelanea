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
        include $bp."mobile-detector.php";
        include $detect->isTablet() || $detect->isMobile() ? $bp . "nav2.php" : $bp . "nav.php";
        include $bp."contact.php";
        include "../../dev/dev.php";
    ?>

    <div style="margin-top: 50px; margin-bottom: 20px; display: flex; justify-content: center; align-items: center;">
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
                                <img class="dep-image" src="../../images/departments/<?= $row['department_image'] ?>">
                            </div>
                        </a>

                    <?php }
                }
            } ?>

        </div>
    </div>
    <?php include '../../includes/footer-image.php'; ?>
</body>
</html>