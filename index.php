<?php
    include "./include/config.php";
    include "./include/db.php";

    $posts=$db->query("SELECT * FROM tbl_posts ORDER BY id DESC");

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
                                        <h5 class="card-title fw-bold">
                                            <?= $item['title']; ?>
                                        </h5>
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
                                            نویسنده : <?= $item['author']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>

                <!-- Sidebar Section -->
                <div class="col-lg-4">
                    <!-- Sesrch Section -->
                    <div class="card">
                        <div class="card-body">
                            <p class="fw-bold fs-6">جستجو در وبلاگ</p>
                            <form action="#">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="جستجو ..."/>
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Categories Section -->
                    <div class="card mt-4">
                        <div class="fw-bold fs-6 card-header">دسته بندی ها</div>
                        <ul class="list-group list-group-flush p-0">
                            <li class="list-group-item">
                                <a class="link-body-emphasis text-decoration-none" href="#">طبیعت</a>
                            </li>
                            <li class="list-group-item">
                                <a class="link-body-emphasis text-decoration-none" href="#">گردشگری</a>
                            </li>
                            <li class="list-group-item">
                                <a class="link-body-emphasis text-decoration-none" href="#">تکنولوژی</a>
                            </li>
                            <li class="list-group-item">
                                <a class="link-body-emphasis text-decoration-none" href="#">متفرقه</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Subscribue Section -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <p class="fw-bold fs-6">عضویت در خبرنامه</p>

                            <form>
                                <div class="mb-3">
                                    <label class="form-label">نام</label>
                                    <input type="text" class="form-control"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ایمیل</label>
                                    <input type="email" class="form-control"/>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-secondary">ارسال</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- About Section -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <p class="fw-bold fs-6">درباره ما</p>
                            <p class="text-justify">
                                لورم ایپسوم متن ساختگی با تولید سادگی
                                نامفهوم از صنعت چاپ و با استفاده از
                                طراحان گرافیک است. چاپگرها و متون بلکه
                                روزنامه و مجله در ستون و سطرآنچنان که
                                لازم است و برای شرایط فعلی تکنولوژی مورد
                                نیاز و کاربردهای متنوع با هدف بهبود
                                ابزارهای کاربردی می باشد.
                            </p>
                        </div>
                    </div>
                </div>
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
