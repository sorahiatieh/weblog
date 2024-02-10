<?php
    $q="SELECT * FROM tbl_categories";
    $categories=$db->query($q);
?>
<div class="col-lg-4">
    <!-- Sesrch Section -->
    <div class="card">
        <div class="card-body">
            <p class="fw-bold fs-6">جستجو در وبلاگ</p>
            <form action="search.php" method="get">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="جستجو ..."/>
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
            <?php if($categories->rowCount()>0): ?>
            <?php foreach($categories as $item): ?>
            <li class="list-group-item">
                <a class="link-body-emphasis text-decoration-none" href="index.php?category=<?= $item['id']; ?>"><?= $item['title']; ?></a>
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Subscribue Section -->
    <div class="card mt-4">
        <div class="card-body">
            <p class="fw-bold fs-6">عضویت در خبرنامه</p>

            <?php
                $invalidInputName="";
                $invalidInputEmail="";
                $message="";

                if(isset($_POST['subscribe'])){
                    if(empty(trim($_POST['name']))){
                        $invalidInputName="فیلد نام الزامیست!";
                    }elseif (empty(trim($_POST['email']))){
                        $invalidInputEmail="فیلد ایمیل الزامیست!";
                    }else{
                        $name=$_POST['name'];
                        $email=$_POST['email'];

                        $subscribeInsert=$db->prepare("INSERT INTO tbl_subscribers (name , email) VALUES (:name , :email)");
                        $subscribeInsert->execute(['name' => $name , 'email' => $email]);

                        $message="عضویت شما با موفقیت انجام شد!";
                    }
                }
            ?>
            <div class="text-success"><?= $message; ?></div>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">نام</label>
                    <input type="text" name="name" class="form-control"/>
                    <div class="form-text text-danger"><?= $invalidInputName; ?></div>
                </div>
                <div class="mb-3">
                    <label class="form-label">ایمیل</label>
                    <input type="email" name="email" class="form-control"/>
                    <div class="form-text text-danger"><?= $invalidInputEmail; ?></div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="subscribe" class="btn btn-secondary">ارسال</button>
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