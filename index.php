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
                <?php include "./include/layout/content.php";?>
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
