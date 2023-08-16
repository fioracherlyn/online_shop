<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';
};
// if(isset($_COOKIE['user_id'])){
//    $user_id = $_COOKIE['user_id'];
// }else{
//    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
// }

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

<section class="orders">

   <h1 class="heading">my orders</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
            $select_product = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_product->execute([$fetch_order['product_id']]);
            if($select_product->rowCount() > 0){
               while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" <?php if($fetch_order['status'] == 'canceled'){echo 'style="border:.2rem solid red";';}; ?>>
      <a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
         <p class="date"><i class="fa fa-calendar"></i><span><?= $fetch_order['date']; ?></span></p>
         <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image" alt="">
         <h3 class="name"><?= $fetch_product['name']; ?></h3>
         <p class="price"><i class="fas fa-indian-rupee-sign"></i> <?= $fetch_order['price']; ?> x <?= $fetch_order['qty']; ?></p>
         <p class="status" style="color:<?php if($fetch_order['status'] == 'delivered'){echo 'green';}elseif($fetch_order['status'] == 'canceled'){echo 'red';}else{echo 'orange';}; ?>"><?= $fetch_order['status']; ?></p>
      </a>
   </div>
   <?php
            }
         }
      }
   }else{
      echo '<p class="empty">no orders found!</p>';
   }
   ?>

   </div>

</section>














<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>