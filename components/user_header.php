<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">
   <section class="flex">
      <nav class="navbar navbar-expand-lg">
         <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                     <a href="index.php">home</a>
                  </li>
                  <li class="nav-item">
                     <a href="about.php">about</a>
                  </li>
                  <li class="nav-item">
                     <a href="products.php">products</a>
                  </li>
                  <li class="nav-item">
                     <a href="orders.php">my orders</a>
                  </li>
                  <li class="nav-item">
                     <a href="contact.php">contact</a>
                  </li>
               </ul>
            </div>

            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               ?>
               
               <div class="cart-icon">
                  <?php
                  $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                  $count_cart_items->execute([$user_id]);
                  $total_cart_items = $count_cart_items->rowCount(); ?>
                  <a href="cart.php" class="cart-btn">cart<span><?= $total_cart_items; ?></span></a>
               </div>
               welcome,
               <a href="profile.php?uid=<?= $fetch_profile['name']; ?>" class="account_name"><?= $fetch_profile['name']; ?></a>
               <?php
            } else {
               ?>
               welcome, guest!   
               <a href="register.php" class="btn btn-register ms-3">register</a>
               <a href="login.php" class="btn btn-login ms-3">login</a>
               <?php
            }
            ?>

            <?php
            if ($select_profile->rowCount() <= 0) {
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            } else {
               ?>
               <a href="logout.php" class="btn btn-logout ms-3"
                  onclick="return confirm('logout from this website?');">logout</a>
               <?php
            }
            ?>
         </div>
      </nav>
   </section>
</header>