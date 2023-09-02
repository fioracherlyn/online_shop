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

if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if ($check_cart->rowCount() > 0) {

      if ($address == '') {
         $message[] = 'please add your address!';
      } else {

         $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
         $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

         $message[] = 'order placed successfully!';
      }

   } else {
      $message[] = 'your cart is empty';
   }

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

   <section class="container checkout">
      <div class="row d-flex justify-content-around py-3 my-3">
         <form action="" method="post" class="shadow-sm card py-2 mb-4 mb-4" style="width: 26rem;">
            <div class="cart-items border bg-secondary-subtle p-3">
               <h3>cart items</h3>
               <?php
               $grand_total = 0;
               $cart_items[] = '';
               $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
               $select_cart->execute([$user_id]);
               if ($select_cart->rowCount() > 0) {
                  while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                     $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                     $total_products = implode($cart_items);
                     $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                     ?>
                     <p><span class="name">
                           <?= $fetch_cart['name']; ?>
                        </span><span class="price">Rp.
                           <?= $fetch_cart['price']; ?> x
                           <?= $fetch_cart['quantity']; ?>
                        </span></p>
                     <?php
                  }
               } else {
                  echo '<p class="empty color-danger bg-danger">your cart is empty!</p>';
               }
               ?>
               <p class="grand-total"><span class="name">grand total: </span><span class="price">Rp.
                     <?= $grand_total; ?>
                  </span></p>
               <a href="cart.php" class="btn btn-outline-success">view cart</a>
            </div>

            <input type="hidden" name="total_products" value="<?= $total_products; ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
            <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
            <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
            <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
            <input type="hidden" name="address" value="<?= $fetch_profile['address'] ?>">

            <div class="user-info">
               <hr>
               <h3>your info</h3>
               <p>
               <div class="profile_photo" style="size: 30%;">
                  <img src="uploaded_photo/<?= $fetch_profile['photo']; ?>" onerror="this.src='assets/undeined.jpeg';">
               </div>
               <span>
                  <?= $fetch_profile['name'] ?>
               </span>
               </p>
               <p><i class="fas fa-phone"></i><span>
                     <?= $fetch_profile['number'] ?>
                  </span></p>
               <p><i class="fas fa-envelope"></i><span>
                     <?= $fetch_profile['email'] ?>
                  </span></p>
               <a href="update_profile_checkout.php" class="btn btn-outline-warning">update profile</a>
               <hr>
               <h3>delivery address</h3>
               <p><i class="fas fa-map-marker-alt"></i><span>
                     <?php if ($fetch_profile['address'] == '') {
                        echo 'please enter your address';
                     } else {
                        echo $fetch_profile['address'];
                     } ?>
                  </span></p>
               <a href="update_address.php" class="btn">update address</a>
               <select name="method" class="box" required>
                  <option value="" disabled selected>select payment method --</option>
                  <option value="cash on delivery">cash on delivery</option>
                  <option value="credit card">credit card</option>
                  <option value="paytm">paytm</option>
                  <option value="paypal">paypal</option>
               </select>
               <input type="submit" value="place order" class="btn btn-success w-100 <?php if ($fetch_profile['address'] == '') {
                  echo 'disabled';
               } ?>" name="submit">
            </div>
         </form>
      </div>
   </section>









   <!-- footer section starts  -->
   <?php include 'components/footer.php'; ?>
   <!-- footer section ends -->






   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>