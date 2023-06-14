<?php require_once 'includes/init.php' ?>
<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>وبلاگ شخصی من</title>
  <link rel="stylesheet" href="Theme/css/font-awesome.min.css">
  <link rel="stylesheet" href="Theme/css/style.css">
  <link rel="stylesheet" href="Theme/css/bootstrap.rtl.min.css">
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">وبلاگ من</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">خانه</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">درباره من</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              دسته بندی
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php
            $showCategory = selectAllCategory();
            foreach ($showCategory as $value) {
                echo "<li><a class='dropdown-item' href='categories.php?cate_id={$value->cate_id}'>{$value->cate_title}</a></li>";
            }
            ?>
            </ul>
          </li>
        </ul>
        <form action="" method="post" class="d-flex">
          <input class="form-control me-2" name="search" type="text" placeholder="جستجو کردن در وبلاگ" aria-label="Search">
          <button class="btn btn-outline-success" name="btnSearch">جستجو</button>
        </form>
      </div>
    </div>
  </nav>
  <section class="home py-5" id="home">
    <div class="container-lg">
      <div class="row align-items-center align-content-center">
        <div class="col-md-12 mt-4 mt-md-0">
          <div class="home-img text-center bg-secondary py-4">
            <img src="Theme/img/profile.jpg" width="250px" height="250px" class="rounded-circle mx-auto d-block" alt="profile img">
          </div>
        </div>
        </div>
        <div class="row align-items-center align-content-center">
        <div class="col-md-12 mt-4 mt-md-0">
          <h3 class="text-muted py-4 text-center">خوش آمدید به وبلاگ من</h3>
          <div class="text-center py-4 ">
          <?php
            $showCategory = selectAllCategory();
            foreach ($showCategory as $value) {
                echo "<a class='btn btn-outline-secondary m-1' href='categories.php?cate_id={$value->cate_id}'>{$value->cate_title}</a>";
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row align-items-center align-content-center">
        <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $title = $_POST['search'];
            $search = searchPost($title);
        }
        if ($search) {
            foreach ($search as $value) {
                ?>
          <div class="col">
            <div class="card h-100">
              <img src="images/<?php echo $value->post_img ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><a href="post.php?post_id=<?php echo $value->post_id ?>"><?php echo $value->post_title ?></a></h5>
                <hr>
                <p class="card-text"><?php echo readMore($value->post_body); ?></p>
                <a href="post.php?post_id=<?php echo $value->post_id ?>" target="_blank" type="button" class="btn btn-outline-secondary btn-block">ادامه مطلب</a>
              </div>
              <div class="card-footer">
                <small class="text-muted">نویسنده مطلب :<?php echo $value->post_author ?></small>
                <small class="text-muted text-crate"> تاریخ انتشار : <?= convertDateToFarsi($value->post_created_at); ?> </small>
              </div>
            </div>
          </div>
          <?php }
        } else {
            echo '<p class="alert alert-info text-center">مطلبی که با جستجوی شما برار باشد پیدا نشد</p>';
        } ?>
        </div>
      </div>
    </div>
  
  </section>
  <footer class="footer border-top py-4">
    <div class="container-lg">
      <div class="row">
        <div class="col-lg-12">
          <p class="m-0 text-center text-danger text-muted">طراحی شده با ❤️</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="Theme/js/bootstrap.bundle.min.js"></script>
</body>

</html>