<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  header('location:login.php');
};

$select_profile = $conn->prepare("SELECT * FROM `users`");
$select_profile->execute();
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
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

  <section class="container profile">
    <div class="row d-flex justify-content-center py-3 my-3">
      <form action="" method="post" class="shadow-sm card py-2 mb-4 mb-4" style="width: 42rem;">
        <h1>my profile</h1>
        <input type="hidden" name="id" value="<?= $fetch_profile['id']; ?>">
        <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
        <input type="hidden" name="email" value="<?= $fetch_profile['email']; ?>">
        <input type="hidden" name="number" value="<?= $fetch_profile['number']; ?>">
        <div class="profile_photo">
          <img src="uploaded_photo/<?= $fetch_profile['photo']; ?>" onerror="this.src='assets/undeined.jpeg';">
        </div>
        <div class="card-body">
          <div class="card-title fs-5">
            <p>name: <?= $fetch_profile['name']; ?></p>
          </div>
          <p>email: <?= $fetch_profile['email']; ?></p>
          <p>number: <?= $fetch_profile['number']; ?></p>
          <p class="card-text">alamat: <?= $fetch_profile['address']; ?></p>
        </div>
        <a href="update_profile.php" class="btn btn-success">update profile</a>
      </form>
    </div>
  </section>
</body>

</html>