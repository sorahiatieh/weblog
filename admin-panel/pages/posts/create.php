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
    }if (empty(trim($_POST['author']))){
        $invalidInputAuthor="فیلد نویسنده الزامیست";
    }if (empty(trim($_FILES['image']['name']))){
        $invalidInputImage="فیلد تصویر الزامیست";
    }if (empty(trim($_POST['body']))){
        $invalidInputImage="فیلد متن الزامیست";
    }


    if(!empty(trim($_POST['title'])) && !empty(trim($_POST['author'])) && !empty(trim($_FILES['image']['name'])) && !empty(trim($_POST['body']))){
        $title=$_POST['title'];
        $author=$_POST['author'];
        $body=$_POST['body'];
        $categoryId=$_POST['categoryId'];
        $nameImage=time(). "-".$_FILES['image']['name'];
        $tmpName=$_FILES['image']['tmp_name'];

        if(move_uploaded_file($tmpName,"../../../uploads/posts/$nameImage")){
            $postInsert=$db->prepare("INSERT INTO tbl_posts (title, author, category_id, body, image) VALUES (:title, :author, :category_id, :body, :image)");
            $postInsert->execute(['title' =>$title , 'author' =>$author , 'category_id' =>$categoryId , 'body' =>$body , 'image' =>$nameImage]);

            header("Location: index.php");
            exit();
        }else{
            echo "upload Error";
        }
    }
}


?>


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
                        <select name="categoryId" class="form-select">
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