<?php
$posts=$db->query("SELECT * FROM tbl_posts ORDER BY id DESC");
?>
<div class="col-lg-8">
    <div class="row g-3">
        <?php if ($posts->rowCount() > 0) : ?>
        <?php foreach ($posts as $item) : ?>
        <?php
        $categoryId = $item['category_id'];
        $postCategory = $db->query("SELECT * FROM tbl_categories WHERE id = $categoryId")->fetch();
        ?>
        <div class="col-sm-6">
            <div class="card">
                <img src="./uploads/posts/<?= $item['image'] ?>" class="card-img-top" alt="<?= $item['title']; ?>"/>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title fw-bold"><?= $item['title']; ?></h5>
                        <div>
                            <span class="badge text-bg-secondary"><?= $postCategory['title']; ?></span>
                        </div>
                    </div>
                    <p class="card-text text-secondary pt-3">
                        <?= substr($item['body'], 0, 500) . "..." ?>
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="#" class="btn btn-sm btn-dark">مشاهده</a>

                        <p class="fs-7 mb-0">
                        نویسنده :    <?= $item['author']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
            <?php endforeach ?>
            <?php else : ?>
                <div class="col">
                    <div class="alert alert-danger">
                        مقاله ای یافت نشد ....
                    </div>
                </div>
            <?php endif ?>
</div>
</div>