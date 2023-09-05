<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}
;

include 'components/add_cart.php';

$select_products = $conn->prepare("SELECT * FROM `products`");
$select_products->execute();
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

  <!-- <div class="container products">
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
    <hr>
    <div class="row d-flex justify-content-around py-3 my-3">
      <?php
      if ($select_products->rowCount() > 0) {
        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
          ?>
          <form action="" method="post" class="shadow-sm card py-2 mb-4 mb-4" style="width: 18rem;">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
            <div class="card-body">
              <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
              <div class="card-title fs-5">
                <?= $fetch_products['name']; ?>
              </div>
              <div class="d-flex justify-content-between fw-bold">
                <div class="card-text fs-4"><span>Rp. </span>
                  <?= $fetch_products['price']; ?>
                </div>
              </div>
              <p class="card-text"><small class="text-body-secondary">dari
                  <?= $fetch_products['post_by']; ?>
                </small>
              </p>
              <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="btn btn-success w-100">Lihat selengkapnya</a>
            </div>
          </form>
          <?php
        }
      } else {
        echo '<p class="empty">no products added yet!</p>';
      }
      ?>
    </div>
  </div> -->

  <!-- Hero Section -->
  <section id="hero">
    <div class="container h-75">
      <div class="row h-100" >
        <div class="col-md-6 hero-tagline my-auto">
          <h1>Website Online <br> Shopping Serba Ada</h1>
          <p><span class="fw-bold">Fyou Shop</span> hadir untuk temukan online shop
            untukmu, untuk membeli atau menjual dengan sumber
            terpercaya.</p>

          <a href="login.php" class="button-lg-primary p-4 px-5">Ayo Login</a>
          <img src="assets/Right Arrow lg.png" alt="">
        </div>
      </div>

      <img src="assets/shopping_cart.png" alt="" class="position-absolute end-0 bottom-0 img-hero ">
    </div>
  </section>

  <?php include 'components/footer.php'; ?>

  <!-- script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <script src="js/script.js"></script>
  <?php include 'components/alert.php'; ?>
  <!-- script end -->
  
</body>

</html>