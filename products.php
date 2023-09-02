<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   header('location:login.php');
};

include 'components/add_cart.php';

$select_products = $conn->prepare("SELECT * FROM `products`");
$select_products->execute();
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
   <link rel="stylesheet" href="components/style.css">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <title>Situs Jual Beli Online Terlengkap</title>

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="container products">
      <div class="row d-flex justify-content-around py-3 my-3">
         <?php
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <form action="" method="post" class="shadow-sm card py-2 mb-4 mb-4" style="width: 18rem;">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <input type="hidden" name="post_by" value="<?= $fetch_products['post_by']; ?>">
                  <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                  <div class="card-body">
                     <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
                     <div class="card-title fs-5">
                        <?= $fetch_products['name']; ?>
                     </div>
                     <div class="d-flex justify-content-between fw-bold">
                        <div class="card-text fs-4"><span>Rp. </span>
                           <?= $fetch_products['price']; ?>
                        </div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                     </div>
                     <p class="card-text"><small class="text-body-secondary">dari <?= $fetch_products['post_by']; ?></small></p>
                     <button type="submit" class="btn btn-cart" name="add_to_cart">Add to Cart</button>
                  </div>
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>

   </section>

  <!-- script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="js/script.js"></script>
  <?php include 'components/alert.php'; ?>
  <!-- script end -->

</body>

</html>