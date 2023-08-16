<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};

include 'components/add_cart.php';
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

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <title>Situs Jual Beli Online Terlengkap</title>
</head>

<body>
  <?php include 'components/user_header.php'; ?>

  <div class="container">

    <!-- carousel start -->
    <div id="carouselExampleIndicators" class="carousel slide py-4">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/car1.jpg" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
          <img src="assets/car2.jpg" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
          <img src="assets/car3.jpg" class="d-block w-100" alt="">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- carousel end -->

    <hr>

    <!-- card -->
    <div class="row d-flex justify-content-around py-3 my-3">
      <div class="shadow-sm card py-2 mb-4 mb-4" style="width: 18rem;">
        <img src="assets/buffback.webp" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">tes cart</h5>
          <p class="card-text">Rp. 55.555</p>
          <p class="card-text"><small class="text-body-secondary">by abcstoremurah</small></p>
          <button type="submit" class="btn btn-cart" name="add_to_cart">Keranjang</button>
        </div>
      </div>
      <div class="shadow-sm card py-2 mb-4" style="width: 18rem;">
        <img src="assets/cycle.webp" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">empty title</h5>
          <p class="card-text">Rp. 50.000</p>
          <p class="card-text"><small class="text-body-secondary">by abcstoremurah</small></p>
          <a href="#" class="btn btn-cart">Add to Cart</a>
        </div>
      </div>
      <div class="shadow-sm card py-2 mb-4" style="width: 18rem;">
        <img src="assets/hs.webp" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">empty title</h5>
          <p class="card-text">Rp. 50.000</p>
          <p class="card-text"><small class="text-body-secondary">by abcstoremurah</small></p>
          <a href="#" class="btn btn-cart">Add to Cart</a>
        </div>
      </div>
      <div class="shadow-sm card py-2 mb-4" style="width: 18rem;">
        <img src="assets/smartphone.webp" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">empty title</h5>
          <p class="card-text">Rp. 50.000</p>
          <p class="card-text"><small class="text-body-secondary">by abcstoremurah</small></p>
          <a href="#" class="btn btn-cart">Add to Cart</a>
        </div>
      </div>
      <div class="shadow-sm card py-2 mb-4" style="width: 18rem;">
        <img src="assets/t-shirt.webp" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">empty title</h5>
          <p class="card-text">Rp. 50.000</p>
          <p class="card-text"><small class="text-body-secondary">by abcstoremurah</small></p>
          <a href="#" class="btn btn-cart">Add to Cart</a>
        </div>
      </div>
      <div class="shadow-sm card py-2 mb-4" style="width: 18rem;">
        <img src="assets/buffback.webp" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">empty title</h5>
          <p class="card-text">Rp. 50.000</p>
          <p class="card-text"><small class="text-body-secondary">by abcstoremurah</small></p>
          <a href="#" class="btn btn-cart">Add to Cart</a>
        </div>
      </div>
      <div class="shadow-sm card py-2 mb-4" style="width: 18rem;">
        <img src="assets/bag.webp" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">empty title</h5>
          <p class="card-text">Rp. 50.000</p>
          <p class="card-text"><small class="text-body-secondary">by abcstoremurah</small></p>
          <a href="#" class="btn btn-cart">Add to Cart</a>
        </div>
      </div>
      <div class="shadow-sm card py-2 mb-4" style="width: 18rem;">
        <img src="assets/buffback.webp" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">empty title</h5>
          <p class="card-text">Rp. 50.000</p>
          <p class="card-text"><small class="text-body-secondary">by abcstoremurah</small></p>
          <a href="#" class="btn btn-cart">Add to Cart</a>
        </div>
      </div>
    </div>

    <!-- card end -->

  </div>

  <!-- script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="js/script.js"></script>
  <?php include 'components/alert.php'; ?>
  <!-- script end -->
  <?php include 'components/footer.php'; ?>
</body>

</html>