<?php 

$bp = "../../includes/";
include $bp."dbconnect.php";

$query = "SELECT department_id, department_name, department_image, department_enabled FROM departments";
$dataset = mysqli_query($Conn,$query);

mysqli_close($Conn);

?>

<div class="main-container" style="
	display: flex;
	justify-content: center;">
    <div style="
        display: flex;
        flex-wrap: wrap;
        align-items: start;
        gap: 10px;">

        <?php if (mysqli_num_rows($dataset) > 0) {while ($row = mysqli_fetch_assoc($dataset)) {

            if($row['department_enabled'] == 1) { ?>

                <a href="seg.php?iddep=<?= $row['department_id'] ?>" style="
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-direction: column;
                    height: 200px;
                    width: 200px;
                    border: 2px solid darkgray;
                    border-radius: 20px;
                    background-color: lightgray;">
                    <img src="../../images/departments/<?= $row['department_image'] ?>" style="height: 100px; width: 100px;">
                    <div><?= $row['department_name'] ?></div>
                </a>

            <?php }

        }} ?>

    </div>
</div>


