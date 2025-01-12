<?php if (isset($urlsArray)) { ?>

    <div class="paging">

        <?php foreach ($urlsArray as $i => $products) {

        if ($i == ($page - 1)) { ?>

            <div class="page-number" style="background-color: lightgray; color: black;">
                <?= ($i+1) ?>
            </div>

        <?php } else { ?>

            <a href="<?= $urlsArray[$i] ?>" class="page-number" style="background-color: #e64747; color: #fff;">
                <?= ($i+1) ?>
            </a>

        <?php } } ?>

    </div>

<?php } ?> 