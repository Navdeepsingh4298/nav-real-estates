<?php
	$page_title = "Nav Real Estates";
	include_once('includes/header.php');
?>

<!-- Carousel -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/house1.jpg" class="d-block w-100" alt="house image">
      <div class="carousel-caption d-none d-md-block bg-dark opacity-75 rounded-3">
        <h5 class="display-3">Welcome to <strong>Nav Real Estates</strong></h5>
        <p class="lead">Have a look around for Best Houses.</p>
				<a href="showhouses.php" class="btn btn-warning">Explore Now</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/house2.jpg" class="d-block w-100" alt="house image">
      <div class="carousel-caption d-none d-md-block bg-dark opacity-75 rounded-3">
        <h5 class="display-4">Wanna Sell a House?</h5>
        <p class="lead">You can Sell your House at zero brokerage fee.</p>
				<a href="addhouse.php" class="btn btn-warning">Sell Now</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/house3.jpg" class="d-block w-100" alt="house image">
      <div class="carousel-caption d-none d-md-block bg-dark opacity-75 rounded-3">
				<h5 class="display-4">Wanna Buy a House?</h5>
        <p class="lead">You can Buy a House at zero brokerage fee.</p>
				<a href="showhouses.php" class="btn btn-warning">Buy Now</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- End of Carousel -->

<hr>

<?php
  include('showhouses.php');
?>

