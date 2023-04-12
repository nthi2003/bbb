<?php

@include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO products(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = $id");
   header('location:admin_page.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin shop</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

 
   <link rel="stylesheet" href="css/main_admin.css">

</head>
<body>
 <div class="menu_nav">
   <a href="login.php">LoginUser</a>
   <a href="loginadmin">Logout</a>
 </div>
 <div class="main">

     
  <div class="container">
  
    
    <div class="admin-product-form-container">
  
  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
     <h3 >New products</h3>
     <div class="List">
     <input type="text" placeholder="enter product name" name="product_name" class="box box2">
     <input type="number" placeholder="enter product price" name="product_price" class="box box2">
     </div>
     <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
     <input type="submit" class=" btn-new" name="add_product" value="add product">
  </form>

</div>
  
     <?php
  
     $select = mysqli_query($conn, "SELECT * FROM products");
     
     ?>
     <div class="product-display">
        <table class="product-display-table">
           <thead>
           <tr>
              <th> image</th>
              <th> name</th>
              <th>price</th>
              <th>action</th>
           </tr>
           </thead>
           <?php while($row = mysqli_fetch_assoc($select)){ ?>
           <tr>
              <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
              <td><?php echo $row['name']; ?></td>
              <td>$<?php echo $row['price']; ?></td>
              <td>
                 <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> </a>
                 <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> </a>
              </td>
           </tr>
        <?php } ?>
        </table>
     </div>
  
  </div>
 </div>


</body>
</html>
