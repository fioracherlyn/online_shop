<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}
;

if (isset($_POST['add_product'])) {
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/' . $image;
   $post_by = $_POST['post_by'];
   $post_by = filter_var($post_by, FILTER_SANITIZE_STRING);

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if ($select_products->rowCount() > 0) {
      $warning_msg[] = 'product name already exists!';
   } else {
      if ($image_size > 2000000) {
         $warning_msg[] = 'image size is too large';
      } else {
         move_uploaded_file($image_tmp_name, $image_folder);
         $insert_product = $conn->prepare("INSERT INTO `products`(name, category, price, image, post_by) VALUES(?,?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image, $post_by]);
         $success_msg[] = 'new product added!';
      }
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/' . $fetch_delete_image['image']);
   // delete from products
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   // delete from cart
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- link to bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"></script>

   <!-- link to custom css -->
   <link rel="stylesheet" href="../components/admin_style.css">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <title>Situs Jual Beli Online Terlengkap</title>
</head>

<body>

   <?php include '../components/admin_header.php' ?>

   <!-- add products section starts  -->

   <section class="add-products mt-4">
      <form action="" method="POST" enctype="multipart/form-data">
         <h3>add product</h3>
         <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box">
         <input type="number" min="0" max="999999" required placeholder="enter product price" name="price"
            onkeypress="if(this.value.length == 10) return false;" class="box">
         <select name="category" class="box" required>
            <option value="" disabled selected>select category --</option>
            <option value="electronics">electronics</option>
            <option value="fashion">fashion</option>
            <option value="food">food</option>
            <option value="voucher">voucher</option>
         </select>
         <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
         <input type="text" required placeholder="post by" name="post_by" maxlength="100" class="box">
         <input type="submit" value="add product" name="add_product" class="btn btn-add">
      </form>
   </section>
   <!-- add products section ends -->

   <!-- show products section starts  -->
   <div class="container">
      <div class="row d-flex justify-content-around py-3 my-3">
         <?php
         $show_products = $conn->prepare("SELECT * FROM `products`");
         $show_products->execute();
         if ($show_products->rowCount() > 0) {
            while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <div class="box shadow-sm card py-2 mb-4 mb-4" style="width: 18rem;">
                  <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <div class="card-body">
                     <div class="cat text-secondary">
                        <?= $fetch_products['category']; ?>
                     </div>
                     <div class="card-title fs-5">
                        <?= $fetch_products['name']; ?>
                     </div>
                     <div class="card-text fw-bold fs-5"><span>Rp. </span>
                        <?= $fetch_products['price']; ?>
                     </div>
                     <p class="card-text"><small class="text-body-secondary">stok dari <?= $fetch_products['post_by']; ?></small></p>
                  </div>
                  <div class="d-flex mb-2">
                     <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="btn btn-success mx-1 w-100">update</a>
                     <a href="products.php?delete=<?= $fetch_products['id']; ?>" onclick="return confirm('delete this products?');" class="btn btn-danger mx-1 w-100">delete</a>
                  </div>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>
   </div>
   <!-- show products section ends -->

   <!-- custom script file link  -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <script src="js/script.js"></script>
   <?php include '../components/alert.php'; ?>
   <!-- custom script end -->
</body>

</html>