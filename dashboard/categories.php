<?php
  include "./include/DashboardHeader.php" ;
  include "../database/env.php" ;
  $query = "SELECT * FROM categories ORDER BY  id";
  $result = mysqli_query($conn, $query);
  $categories = mysqli_fetch_all($result, 1);
  // print_r($categories);
  // exit();


?>             

              <div class="row">
                
                <div class="col-xl-4 mb-6 order-0">
                  <div class="card">
                  <form action="../controller/CategoryStore.php" enctype="multipart/form-data" method="post" >
                    <div class="card-header py-0 pt-3 d-flex justify-content-between align-items-center">
                        <h4><?= isset($_REQUEST['id']) ? 'Edit' :'Add' ?> Categories</h4>
                        <button class="btn btn-primary"><?= isset($_REQUEST['id']) ? 'Update' :'Store' ?></button>
                    </div>
                    <div class="card-body">
                        <input value="<?= $_REQUEST['title'] ?? null ?>" name="title" type="text" class="form-control my-2" placeholder="Category Title">
                        <input  type="hidden" name="id" value="<?= $_REQUEST['id'] ?? null ?>">
                        <span class="text-danger"><?= $_SESSION['errors']['title_error'] ?? null ?></span>
                        
                    </div>
                  </form>
                  </div>
                </div>
                <div class="col-xl-8 mb-6 order-0">
                  <div class="card">
                            
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th></th>
                                </tr>

                              <?php

                                foreach($categories as $key=>$category){
                              ?>
                              <tr>
                                  <td><?= ++$key ?></td>
                                  <td><?= $category['title'] ?></td>
                                  <td>
                                    <a href="./categories.php?id=<?= $category['id'] ?>&title=<?= $category['title'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="../controller/CategoryDelete.php?id=<?= $category['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                  </th>
                              </tr>
                              <?php
                                }
                              ?>

                               
                            </table>
                        </div>


                  </div>
                </div>
               
               
              </div>
              
            </div>

<?php

include "./include/DashboardFooter.php" ;
?>


<?php

if(isset($_SESSION['success'])){
?>


<script>
    Toast.fire({
  icon: "success",
  title: "Category store successfully"
});
</script>





<?php
}

unset($_SESSION['errors']);
unset($_SESSION['success']);