<?php
    include "./include/layout/header.php";

    $posts=$db->query("SELECT * FROM tbl_posts ORDER BY  id DESC LIMIT 5");
    $comments=$db->query("SELECT * FROM tbl_comments ORDER BY  id DESC LIMIT 5");
    $categories=$db->query("SELECT * FROM tbl_categories ORDER BY  id DESC");
?>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar Section -->
                <?php
                    include "./include/layout/sidebar.php";
                ?>

                <!-- Main Section -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="fs-3 fw-bold">داشبورد</h1>
                    </div>

                    <!-- Recently Posts -->
                    <div class="mt-4">
                        <h4 class="text-secondary fw-bold">مقالات اخیر</h4>
                        <?php if($posts->rowCount() >0): ?>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>عنوان</th>
                                        <th>نویسنده</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($posts as $item):  ?>
                                    <tr>
                                        <th><?= $item['id']; ?></th>
                                        <td><?= $item['title']; ?></td>
                                        <td><?= $item['author']; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-dark">ویرایش</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                            <div class="col">
                                <div class="alert alert-danger">مقاله ای یافت نشد...</div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Recently Comments -->
                    <div class="mt-4">
                        <h4 class="text-secondary fw-bold">کامنت های اخیر</h4>
                        <?php if($posts->rowCount() >0): ?>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>نام</th>
                                        <th>متن کامنت</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php foreach ($comments as $item):  ?>
                                    <tr>
                                        <th><?= $item['id']; ?></th>
                                        <td><?= $item['name']; ?></td>
                                        <td>
                                           <?= $item['comment']; ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-dark disabled">تایید شده</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
                                        </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php else: ?>
                                <div class="col">
                                    <div class="alert alert-danger">کامنتی یافت نشد...</div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mt-4">
                        <h4 class="text-secondary fw-bold">دسته بندی</h4>
                        <?php if($categories->rowCount() >0): ?>
                        <div class="table-responsive small">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>عنوان</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($categories as $item): ?>
                                    <tr>
                                        <th><?= $item['id']; ?></th>
                                        <td><?= $item['title']; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-dark">ویرایش</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">حذف</a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php endforeach; ?>
                            </table>
                            <?php else: ?>
                            <div class="col">
                                <div class="alert alert-danger">کامنتی یافت نشد...</div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>

<?php
    include "./include/layout/footer.php";
?>
