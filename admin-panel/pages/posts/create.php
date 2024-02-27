<?php
include "../../include/layout/header.php";

$categories = $db->query("SELECT * FROM tbl_categories");

$invalidInputTitle="";
$invalidInputAuthor="";
$invalidInputImage="";
$invalidInputBody="";


if(isset($_POST['addPost'])){
    if(empty(trim($_POST['title']))){
        $invalidInputTitle="فیلد عنوان الزامیست";
    }elseif (empty(trim($_POST['author']))){
        $invalidInputAuthor="فیلد نویسنده الزامیست";
    }elseif (empty(trim($_FILES['image']))){
        $invalidInputImage="فیلد تصویر الزامیست";
    }elseif (empty(trim($_POST['body']))){
        $invalidInputImage="فیلد متن الزامیست";
    }
}
?>


<body>
<header class="navbar sticky-top bg-secondary flex-md-nowrap p-0 shadow-sm">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5 text-white" href="index.html">پنل ادمین</a>

    <button class="ms-2 nav-link px-3 text-white d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
        <i class="bi bi-justify-left fs-2"></i>
    </button>
</header>

<div class="container-fluid">
    <div class="row">
        <?php
            include "../../include/layout/sidebar.php"
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">ایجاد مقاله</h1>
            </div>

            <!-- create Article -->
            <div class="mt-4">
                <form method="post" class="row g-4" enctype="multipart/form-data">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">عنوان مقاله</label>
                        <input type="text" name="title" class="form-control"/>
                        <div class="form-text text-danger"><?= $invalidInputTitle ?></div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">نویسنده مقاله</label>
                        <input type="text" name="author" class="form-control"/>
                        <div class="form-text text-danger"><?= $invalidInputAuthor ?></div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">دسته بندی مقاله</label>
                        <select class="form-select">
                            <?php if($categories->rowCount() >0):?>
                                <?php foreach ($categories as $item): ?>
                                     <option value="<?= $item['id'] ?>"><?= $item['title'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label for="formFile" class="form-label">تصویر مقاله</label>
                        <input class="form-control" name="image" type="file"/>
                        <div class="form-text text-danger"><?= $invalidInputImage; ?></div>
                    </div>

                    <div class="col-12">
                        <label for="formFile" class="form-label">متن مقاله</label>
                        <textarea class="form-control" name="body" rows="6"></textarea>
                        <div class="form-text text-danger"><?= $invalidInputBody; ?></div>
                    </div>

                    <div class="col-12">
                        <button type="submit" name="addPost" class="btn btn-dark">
                            ایجاد
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<?php
    include "../../include/layout/footer.php"
?>