<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
 }else{
    $warning_msg[] = 'please login first';
    header('location:login.php');
 };
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

<section class="products">

   <h1 class="heading">all products</h1>

   <div class="box-container">

   <?php 
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_prodcut = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="POST" class="box">
      <img src="uploaded_files/<?= $fetch_prodcut['image']; ?>" class="image" alt="">
      <h3 class="name"><?= $fetch_prodcut['name'] ?></h3>
      <input type="hidden" name="product_id" value="<?= $fetch_prodcut['id']; ?>">
      <div class="flex">
         <p class="price"><i class="fas fa-rupiah-sign"></i><?= $fetch_prodcut['price'] ?></p>
         <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
      </div>
      <input type="submit" name="add_to_cart" value="add to cart" class="btn">
      <a href="checkout.php?get_id=<?= $fetch_prodcut['id']; ?>" class="delete-btn">buy now</a>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>

   </div>

</section>







<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>