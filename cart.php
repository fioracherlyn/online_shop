<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
}
;

if (isset($_POST['delete'])) {
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'cart item deleted!';
}

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

$grand_total = 0;

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
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <title>Situs Jual Beli Online Terlengkap</title>
</head>

<body>

   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header section ends -->

   <!-- shopping cart section starts  -->

   <section class="container products">
      <!-- <h1 class="title">your cart</h1> -->
      <div class="row d-flex justify-content-around py-3 my-3">
         <?php
         $grand_total = 0;
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if ($select_cart->rowCount() > 0) {
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <form action="" method="post" class="shadow-sm card py-2 mb-4 mb-4" style="width: 18rem;">
                  <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                  <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                  <div class="card-body">
                     <div class="card-title fs-5">
                        <?= $fetch_cart['name']; ?>
                     </div>
                     <div class="d-flex justify-content-between fw-bold">
                        <div class="card-text fs-4">Rp. <?= $fetch_cart['price']; ?></div>
                        <div class="card-text">
                           <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                           <button type="submit" class="fas fa-check" name="update_qty"></button>
                        </div>
                     </div>
                     <div class="sub-total">Total: Rp.
                        <?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>
                     </div>
                     <button type="submit" class="fas fa-trash text-danger p-2 w-100" name="delete" onclick="return confirm('delete this item?');"></button>
                  </div>
               </form>
               <?php
               $grand_total += $sub_total;
            }
         } else {
            echo '<p class="empty">your cart is empty</p>';
         }
         ?>
      </div>

      <div class="">
         <p>cart total : <span>Rp.
               <?= $grand_total; ?>
            </span></p>
         <a href="checkout.php" class="btn btn-success <?= ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to
            checkout</a>
         <form action="" method="post">
            <button type="submit" class="btn btn-danger <?= ($grand_total > 1) ? '' : 'disabled'; ?>" name="delete_all"
               onclick="return confirm('delete all from cart?');">delete all</button>
         </form>
      </div>
   </section>
   <!-- shopping cart section ends -->

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>