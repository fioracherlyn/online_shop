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
            <div class="collapse navbar-collapse">
               <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                     <a href="dashboard.php">home</a>
                  </li>
                  <li class="nav-item">
                     <a href="products.php">products</a>
                  </li>
                  <li class="nav-item">
                     <a href="placed_orders.php">orders</a>
                  </li>
                  <li class="nav-item">
                     <a href="admin_accounts.php">admins</a>
                  </li>
                  <li class="nav-item">
                     <a href="users_accounts.php">users</a>
                  </li>
                  <li class="nav-item">
                     <a href="messages.php">messages</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p>
            <?= $fetch_profile['name']; ?>
         </p>
         <a href="update_profile.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">login</a>
            <a href="register_admin.php" class="option-btn">register</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');"
            class="delete-btn">logout</a>
      </div>

   </section>

</header>