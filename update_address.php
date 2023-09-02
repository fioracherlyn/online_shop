<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:index.php');
}
;

if (isset($_POST['submit'])) {

   $address = $_POST['flat'] . ', ' . $_POST['building'] . ', ' . $_POST['area'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ' - ' . $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $success_msg[] = 'address saved!';

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

   <?php include 'components/user_header.php' ?>

   <section class="form-container">
      <form action="" method="post">
         <h3>your address</h3>
         <input type="text" class="box" placeholder="flat no." required maxlength="50" name="flat">
         <input type="text" class="box" placeholder="building no." required maxlength="50" name="building">
         <input type="text" class="box" placeholder="area name" required maxlength="50" name="area">
         <input type="text" class="box" placeholder="city name" required maxlength="50" name="city">
         <input type="text" class="box" placeholder="state name" required maxlength="50" name="state">
         <input type="number" class="box" placeholder="pin code" required max="999999" min="0" maxlength="6"
            name="pin_code">
         <div class="d-flex justify-content-between mt-2">
            <a href="checkout.php" class="btn btn-link">&larr; go back</a>
            <input type="submit" value="save address" name="submit" class="btn btn-success">
         </div>
      </form>

   </section>

   <?php include 'components/footer.php'; ?>

   <!-- script -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
   <script src="js/script.js"></script>
   <?php include 'components/alert.php'; ?>
   <!-- script end -->

</body>

</html>