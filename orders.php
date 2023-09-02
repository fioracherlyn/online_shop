<?php

include 'components/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;
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

   <section class="container orders">
      <h1 class="title">your orders</h1>
      <div class="row d-flex justify-content-around py-3 my-3">
         <?php
         if ($user_id == '') {
            echo '<p class="empty">please login to see your orders</p>';
         } else {
            $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
            $select_orders->execute([$user_id]);
            if ($select_orders->rowCount() > 0) {
               while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <div class="box">
                     <p>placed on : <span>
                           <?= $fetch_orders['placed_on']; ?>
                        </span></p>
                     <p>name : <span>
                           <?= $fetch_orders['name']; ?>
                        </span></p>
                     <p>email : <span>
                           <?= $fetch_orders['email']; ?>
                        </span></p>
                     <p>number : <span>
                           <?= $fetch_orders['number']; ?>
                        </span></p>
                     <p>address : <span>
                           <?= $fetch_orders['address']; ?>
                        </span></p>
                     <p>payment method : <span>
                           <?= $fetch_orders['method']; ?>
                        </span></p>
                     <p>your orders : <span>
                           <?= $fetch_orders['total_products']; ?>
                        </span></p>
                     <p>total price : <span>$
                           <?= $fetch_orders['total_price']; ?>/-
                        </span></p>
                     <p> payment status : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                        echo 'red';
                     } else {
                        echo 'green';
                     }
                     ; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
                  </div>
                  <?php
               }
            } else {
               echo '<p class="empty">no orders placed yet!</p>';
            }
         }
         ?>

      </div>

   </section>














   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

   <script src="js/script.js"></script>

   <?php include 'components/alert.php'; ?>

</body>

</html>