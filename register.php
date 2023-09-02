<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

if (isset($_POST['submit'])) {

   // $image = $_POST['image'];
   // $image = filter_var($image, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $photo = $_FILES['photo']['name'];
   $photo = filter_var($photo, FILTER_SANITIZE_STRING);
   $photo_tmp_name = $_FILES['photo']['tmp_name'];
   $photo_folder = 'uploaded_photo/' . $photo;

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
   $select_user->execute([$email, $number]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if ($select_user->rowCount() > 0) {
      $warning_msg[] = 'email or number already exists!';
   } else {
      if ($pass != $cpass) {
         $warning_msg[] = 'confirm password not matched!';
      } else {
         move_uploaded_file($photo_tmp_name, $photo_folder);
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password, photo) VALUES(?,?,?,?,?)");
         $insert_user->execute([$name, $email, $number, $cpass, $photo]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if ($select_user->rowCount() > 0) {
            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
         }
      }
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

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <title>Situs Jual Beli Online Terlengkap</title>

</head>

<body>

   <!-- header section starts  -->
   <?php include 'components/user_header.php'; ?>
   <!-- header section ends -->

   <div class="form-container">
      <form action="" method="POST" enctype="multipart/form-data">
         <h3>register now</h3>
         <input type="file" class="box" name="photo" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
         <input type="text" class="box" name="name" required placeholder="enter your name">
         <input type="email" class="box" name="email" required placeholder="enter your email">
         <input type="number" class="box" name="number" required placeholder="enter your number">
         <input type="password" class="box" name="pass" required placeholder="enter your password">
         <input type="password" class="box" name="cpass" required placeholder="confirm your password">
         <input type="submit" name="submit" value="register now" class="box form-btn">
         <p>already have an account? <a href="login.php">login now</a></p>
      </form>
   </div>

   <!-- script -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <script src="js/script.js"></script>
   <?php include 'components/alert.php'; ?>
   <!-- script end -->

</body>

</html>