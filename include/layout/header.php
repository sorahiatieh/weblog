<?php


    $q="SELECT * FROM tbl_categories";
    $categories=$db->query($q);
?>
<header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
    <a href="index.php" class="fs-4 fw-medium link-body-emphasis text-decoration-none">
       Sorahi
    </a>

    <nav class="d-inline-flex mt-2 mt-md-0 me-md-auto">
        <?php if($categories -> rowCount()>0): ?>
        <?php foreach ($categories as $item): ?>
            <a class="fw-bold me-3 py-2 link-body-emphasis text-decoration-none" href="#"><?= $item['title']; ?></a>
        <?php endforeach; ?>
        <?php endif; ?>
    </nav>
</header>