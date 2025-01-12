<?php 

$iddep = $_GET['iddep'];
$bp = "../../includes/";
include $bp."dbconnect.php";

$query = "SELECT segment_id, segment_name, segment_image FROM segments WHERE department_id = $iddep";
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

        <?php if (mysqli_num_rows($dataset) > 0) {while ($row = mysqli_fetch_assoc($dataset)) { ?>

            <a href="prod.php?iddep=<?= $iddep ?>&idsubdep=<?= $row['segment_id'] ?>" style="
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                height: 200px;
                width: 200px;
                border: 2px solid darkgray;
                border-radius: 20px;
                background-color: lightgray;">
                <img src="../../images/departments/<?= $row['segment_image'] ?>" style="height: 100px; width: 100px;">
                <div><?= $row['segment_name'] ?></div>
            </a>

        <?php }} ?>

    </div>
</div>


