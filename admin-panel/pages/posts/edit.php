<?php
include "../../include/layout/header.php";

if(isset($_GET['id'])){
    $postId=$_GET['id'];
    $post=$db->prepare("SELECT * FROM tbl_posts WHERE id= :id");
    $post->execute(['id' =>$postId]);
    $post=$post->fetch();

    $categories = $db->query("SELECT * FROM tbl_categories");
}
?>

    <div class="container-fluid">
        <div class="row">
            <?php
            include "../../include/layout/sidebar.php"
            ?>

            <!-- Main Section -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="fs-3 fw-bold">ویرایش مقاله</h1>
                </div>

                <!-- Posts -->
                <div class="mt-4">
                    <form method="post" class="row g-4">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label class="form-label">عنوان مقاله</label>
                            <input type="text" name="title" class="form-control" value="<?= $post['title'] ?>"/>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label class="form-label">نویسنده مقاله</label>
                            <input type="text" name="author" class="form-control" value="<?= $post['author'] ?>"/>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label class="form-label">دسته بندی مقاله</label>
                            <select name="categoryId" class="form-select">
                                <?php if($categories->rowCount() >0):?>
                                    <?php foreach ($categories as $item): ?>
                                        <option <?= ($item['id'] == $post['category_id']) ? 'selected' : '' ?> value="<?= $item['id'] ?>"><?= $item['title'] ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="formFile" class="form-label">تصویر مقاله</label>
                            <input class="form-control" name="image" type="file" />
                        </div>

                        <div class="col-12">
                            <label for="formFile" class="form-label">متن مقاله</label>
                            <textarea class="form-control" rows="8"><?= $post['body'] ?></textarea>
                        </div>


                        <div class="col-12 col-sm-6 col-md-4">
                            <img class="rounded" src="../../../uploads/posts/<?= $post['image'] ?>" width="300" />
                        </div>

                        <div class="col-12">
                            <button name="editPost" type="submit" class="btn btn-dark">
                                ویرایش
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