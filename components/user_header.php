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
                     <a href="contacts.php">contacts</a>
                  </li>
               </ul>
            </div>
            <!-- <a href="shopping_cart.php" class="shopping-cart mx-5"><span class="fas fa-shopping-cart"></span></a> -->
            <div class="cart-icon">
               <?php
               $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
               $count_cart_items->execute([$user_id]);
               $total_cart_items = $count_cart_items->rowCount();
               ?>
               <a href="cart.php" class="cart-btn">cart<span><?= $total_cart_items; ?></span></a>
            </div>
            <!-- menampilkan nama user di header ketika login -->
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if ($select_profile->rowCount() > 0) {
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               ?>
               welcome,
               <a href="profile.php" class="profile"><?= $fetch_profile['name']; ?></a>
               <?php
            } else {
               ?>
               welcome, guest!
               <!-- <a href="login.php" class="login-btn px-2">login</a> -->
               <a href="login.php" class="btn btn-login ms-3">login</a>
               <?php
            }
            ?>

            <!-- menghilangkan tombol logout ketika user dalam keadaan tidak login -->
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