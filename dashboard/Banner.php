<?php

include "./include/DashboardHeader.php" ;
?>
              
              
              
              <div class="row">
                
                <div class="col-xxl-4 mb-6 order-0">
                  <div class="card">
                 <form action="../controller/BannerStore.php" enctype="multipart/form-data" method="POST">
                 <div class="card-header py-0 pt-3 d-flex justify-content-between align-items-center">
                    <h4>Add Banner</h4>
                    <button class="btn btn-primary">Store</button>
                    </div>
                    <div class="card-body">
                        <input  name="title" type="text" class="form-control my-2" placeholder="Banner Title">
                        <span class="text-danger"><?= $_SESSION['errors']['title_error'] ?? null ?></span>
                        <textarea name="detail" class="form-control my-2" placeholder="Banner detail"></textarea>
                        <span class="text-danger"><?= $_SESSION['errors']['detail_error'] ?? null ?></span>
                        <input type="text" name="ctaTitle" class="form-control my-2" placeholder="Cta Title">
                        <input type="text" name="ctaLink" class="form-control my-2" placeholder="Cta Link">
                        <input type="text" name="videoLink" class="form-control my-2" placeholder="Video Link">
                       
                       <label for ="" class="d-block">
                          Banner Image
                       <input type="file" name="bannerImage" class="form-control">
                       </label>
                       <span class="text-danger"><?= $_SESSION['errors']['bannerImage_error'] ?? null ?></span>
                        
                    </div>
                 </form>
                  </div>
                </div>

                <div class="col-xxl-8 mb-6 order-0">
                  <div class="card">
                    <div class="table-responsive">
                        <table class="table">

                           <tr>
                              <th>#</th>
                              <th>Banner Title</th>
                              <th>Cta</th>
                              <th>Video</th>
                              <th></th>
                            </tr>

                            <tr>
                              <td>#</td>
                              <td>Banner Title</td>
                              <td>Cta</td>
                              <td>Video</td>
                              <td></td>
                            </tr>
                            
                        </table>
                           
                      
                    </div>
                    </div>
                    
                  </div>
                </div>
               
               
              

<?php

include "./include/DashboardFooter.php" ;
?>
 <?php
     if (isset($_SESSION['success'])){
     ?>
     <script>
        Toast.fire({
      icon: "success",
      title: "Banner Store successfully"
     });
     </script>



   <?php
     }
     unset($_SESSION['errors'])

    ?>