<?php

include "./include/DashboardHeader.php" ;
include"../database/env.php";
$query = "SELECT * FROM  banners  ORDER BY id DESC";
$res = mysqli_query($conn, $query);
$banners = mysqli_fetch_all($res, MYSQLI_ASSOC);

?>
 
 <div class="row">
                
  <div class="col-xxl-4 mb-6 order-0">
    <div class="card">
  <form action="../controller/BannerStore.php" enctype="multipart/form-data" method="POST">
  <div class="card-header py-0 pt-3 d-flex justify-content-between align-items-center">
  <h4><?= isset($_REQUEST['id']) ? 'Edit' :'Add' ?> Banner</h4>
      <!-- <h4>Add Banner</h4> -->
      <button class="btn btn-primary"><?= isset($_REQUEST['id']) ? 'Update' :'Store' ?></button>
      </div>
  <div class="card-body">
  <label for="">
  Banner Title
      <input name="title" type="text" class="form-control my-2" value="<?= ($_SESSION['auth']['title']) ?? null ?>"
       placeholder="Banner Title">
       <span class="text-danger"><?= isset($_SESSION['errors']['title_error']) ?></span>
  </label>
    
  <label for="">
            Banner Detail
            <textarea name="detail" class="form-control my-2" placeholder="Banner Detail"></textarea>
            <span class="text-danger"><?= $_SESSION['errors']['detail_error'] ?? ''?></span>
          </label>
          <label for="">
            Cta Title
            <input type="" name="ctaTitle" class="form-control my-2" placeholder="Cta Title">
            <span class="text-danger"><?= $_SESSION['errors']['cta_error'] ?? '' ?></span>

          </label>
          <label for="">
            Cta Link

            <input type="" name="ctaLink" class="form-control my-2"  placeholder="Cta Link">
          </label>
          <label for="">
            Video Link
            <input type="" name="videoLink" class="form-control my-2"  placeholder="Video Link">
          </label>
          <label for="" class="d-block">
            Banner Image
            <input type="file"  name="banner_img" class="form-control">
          </label>
          <span class="text-danger"><?= $_SESSION['errors']['bannerImage_error'] ?? '' ?></span>
        </div>
      </form>
    </div>
  </div>

<div class="col-xxl-8 mb-6 order-0">
<div class="card">
<div class="table-responsive">
    <table class="table">

    <tr>
            <th>ID</th>
            <th>Banner Title</th>
            <th>Banner Detail</th>
            <th>Cta Title</th>
            <th>Cta Link</th>
            <th>Video Link</th>
            <th>Banner image</th>
           
           
          </tr>
          <?php foreach ($banners as  $key => $banner){
         ?>

          <tr>
            <td><?= ++$key ?></td>
            <td><?= empty($banner['title']) ? '---' : $banner['title'] ?></td>
            <td><?= empty($banner['detail']) ? '---' : (strlen($banner['detail']) > 13 ? substr($banner['detail'], 0, 10) . '....' : $banner['detail']) ?></td>
            <td><?= empty($banner['cta_title']) ? '---' : $banner['cta_title'] ?></td>
            <td><?= empty($banner['cta_link']) ? '---' : (strlen($banner['cta_link']) > 5 ? substr($banner['cta_link'], 0, 5) . '....' : $banner['cta_link']) ?></td>
            <td><?= empty($banner['video_link']) ? '---' : (strlen($banner['video_link']) > 13 ? substr($banner['video_link'], 0, 10) . '....' : $banner['video_link']) ?></td>
            <td><?= empty($banner['banner_img']) ? '---' : (strlen($banner['banner_img']) > 5 ? substr($banner['banner_img'], 0, 5) . '....' : $banner['banner_img']) ?></td>

            <td>
            <a href="./Banner.php?id=<?= $banner['id'] ?>&title=<?= $banner['title'] ?>" class="btn btn-primary btn-sm">Edit</a>
          </td>
          <td>
              <a href="../controller/BannerDelete.php?id=<?= $banner['id'] ?>" class="btn btn-danger btn-delete btn-sm">Delete</a>
            </td>
          </tr>
<?php


          }

          ?>


        </table>
      </div>
    </div>
  </div>

<?php
include("./include/DashboardFooter.php");

if (isset($_SESSION["success"])) {
?>
    <script>
        Toast.fire({
            icon: "success",
            title: "Banner Store successfull"
        });
    </script>
<?php
}

unset($_SESSION["errors"]);
unset($_SESSION["success"]);
?>