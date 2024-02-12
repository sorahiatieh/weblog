<?php
include "./include/layout/header.php";

if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $posts = $db->prepare('SELECT * FROM tbl_posts WHERE title LIKE :keyword');
    $posts->execute(['keyword' => "%$keyword%"]);
}
?>

<main>
    <!-- Content Section -->
    <section class="mt-4">
        <div class="row">
            <!-- Posts Content -->
            <div class="col-lg-8">
                <div class="alert alert-secondary">
                    پست های مرتبط با کلمه [ <?= $_GET['search'] ?> ]
                </div>

                <?php if ($posts->rowCount() == 0) : ?>
                    <div class="alert alert-danger">
                        مقاله مورد نظر پیدا نشد !!!!
                    </div>
                <?php else : ?>
                    <div class="row g-3">
                        <?php foreach ($posts as $post) : ?>
                            <?php
                            $categoryId = $post['category_id'];
                            $postCategory = $db->query("SELECT * FROM tbl_categories WHERE id = $categoryId")->fetch();
                            ?>
                            <div class="col-sm-6">
                                <div class="card">
                                    <img src="./uploads/posts/<?= $post['image'] ?>" class="card-img-top" alt="post-image" />
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="card-title fw-bold">
                                                <?= $post['title'] ?>
                                            </h5>
                                            <div>
                                                <span class="badge text-bg-secondary"><?= $postCategory['title'] ?></span>
                                            </div>
                                        </div>
                                        <p class="card-text text-secondary pt-3">
                                            <?= substr($post['body'], 0, 500) . "..." ?>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="single.php?post=<?= $post['id']?>" class="btn btn-sm btn-dark">مشاهده</a>

                                            <p class="fs-7 mb-0">
                                                نویسنده : <?= $post['author'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
            </div>

            <?php
            include "./include/layout/sidebar.php";
            ?>
        </div>
    </section>
</main>

<?php
include "./include/layout/footer.php";
?>