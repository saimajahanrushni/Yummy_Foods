<?php
  include "./include/DashboardHeader.php" ;
  include "../database/env.php" ;
  $query = "SELECT * FROM categories ORDER BY  id DESC";
  $result = mysqli_query($conn, $query);
  $categories = mysqli_fetch_all($result, 1);

  $foodQuery = "SELECT foods.id, foods.category_id, categories.title AS category_title, foods.title, foods.food_img, foods.status  FROM foods INNER JOIN categories ON
foods.category_id = categories.id ORDER BY foods.id DESC";
  $foodResults = mysqli_query($conn, $foodQuery);
  $foods = mysqli_fetch_all($foodResults, 1);

  // echo "<pre>";
  // print_r($foods);
  // exit();





?>
              
              
              
              <div class="row">
                
                <div class="col-xl-4 mb-6 order-0">
                  <div class="card">
                  <form action="../controller/FoodStore.php" enctype="multipart/form-data" method="post" >
                    <div class="card-header py-0 pt-3 d-flex justify-content-between align-items-center">
                        <h4><?= isset($_REQUEST['id']) ? 'Edit' :'Add' ?> Foods</h4>
                        <button class="btn btn-primary"><?= isset($_REQUEST['id']) ? 'Update' :'Store' ?></button>
                    </div>
                    <div class="card-body">
                        <input name="title" type="text" class="form-control my-2" placeholder="Food Title">
                        <span class="text-danger"><?= $_SESSION['errors']['title_error'] ?? null ?></span>
                        <input name="detail" type="text" class="form-control my-2" placeholder="Food Detail">
                        <span class="text-danger"><?= $_SESSION['errors']['detail_error'] ?? null ?></span>
                        <input name="price" type="number" class="form-control my-2" placeholder="Food Price">
                        <span class="text-danger"><?= $_SESSION['errors']['price_error'] ?? null ?></span>
                        <label for="" class="d-block">
                          Food Image
                        <input name="food_img" type="file" class="form-control my-2">
                        </label>
                        <span class="text-danger"><?= $_SESSION['errors']['food_img_error'] ?? null ?></span>
                        <input  type="hidden" name="id" value="<?= $_REQUEST['id'] ?? null ?>">
                        <select name="category" class="form-control">
                        <?php
                        foreach($categories as $category){
                        ?>
                          
                          <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                      
                        <?php
                        }
                        ?>
                            </select>
                        
                    </div>
                  </form>
                  </div>
                </div>
                <div class="col-xl-8 mb-6 order-0">
                  <div class="card">
                            
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Foods</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th></th>
                                </tr>

                              <?php

                                foreach($foods as $key=>$food){
                              ?>
                              <tr>
                                  <td><?= ++$key ?></td>
                                  <td><img width="40px" src="../<?= $food['food_img']  ?>" class="me-2"  alt=""><?= $food['title'] ?></td>
                                  <td class="text-center">
                                    <a href="../controller/FoodStatus.php?id=<?= $food['id'] ?>&status=<?= $food['status'] ?>" class="text-warning">
                                    <i class='bx bx<?= $food['status'] == 1 ? 's' : null ?>-star'></i>
                                    </a>
                                    
                                  </td>
                                  <td><?= $food['category_title'] ?></td>
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