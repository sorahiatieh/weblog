<?php
    include "./include/config.php";
    include "./include/db.php";

    if(isset($_GET['category'])){
     $categoryId=$_GET['category'];
     $posts=$db->prepare("SELECT * FROM tbl_posts WHERE category_Id= :id ORDER BY id DESC");
     $posts->execute(['id'=>$categoryId]);
    }else {
        $posts = $db->query("SELECT * FROM tbl_posts ORDER BY id DESC");
    }
    //echo "<pre>";
     //print_r($posts->fetch());

?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Weblog project </title>

    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    />
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
            crossorigin="anonymous"
    />

    <link rel="stylesheet" href="./assets/css/style.css"/>
</head>

<body>
<div class="container py-3">
    <?php
        include "./include/layout/header.php";
    ?>

    <main>
        <!-- Slider Section -->
        <?php
            include "./include/layout/slider.php";
        ?>

        <!-- Content Section -->
        <section class="mt-4">
            <div class="row">
                <!-- Posts Content -->
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
                <!-- Sidebar Section -->
                <?php
                 include "./include/layout/sidebar.php";
                ?>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <?php
        include "./include/layout/footer.php";
    ?>
</div>
<script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"
></script>
</body>
</html>
