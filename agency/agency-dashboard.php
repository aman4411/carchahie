<?php $currentPage = "Add Car";
include '../includes/header.php';

if (!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')) {
  header('Location: ../login.php');
}

?>

<form class="col-12 col-md-8 col-lg-8 col-xl-6 mt-5" id="add-car-form" onsubmit="validateAddCarForm(event,<?=  $_SESSION['userId']?>)">
  <div class="row">
    <div class="col text-center mt-3">
      <h3>Add Car for Rental Service</h3>
      <p class="text-h3">Add your car for rental service & get it listed instantly to get the best customers in the market </p>
    </div>
  </div>
  <div class="row align-items-center">
    <div class="col mt-4">
      <input type="text" name="model" class="form-control" placeholder="Model Name">
    </div>
  </div>
  <div class="row align-items-center mt-4">
    <div class="col">
      <input type="text" name="number" class="form-control" placeholder="Vehicle Number">
    </div>
  </div>
  <div class="row align-items-center mt-4">
    <div class="col">
      <input type="number" name="capacity" class="form-control" placeholder="Sitting Capacity">
    </div>
  </div>
  <div class="row align-items-center mt-4">
    <div class="col">
      <input type="number" name="rent" class="form-control" placeholder="Rent/Day (&#8377;)">
    </div>
  </div>
  <div class="row justify-content-start mt-4">
    <div class="col">
      <span class="text-danger" id="add-car-form-error">*Error</span>
      <button class="btn btn-primary mt-3" type="submit" id="add-car-button">Add Car</button>
      <button id="add-car-loading-button" class="btn btn-primary mt-3" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
      </button>
    </div>
  </div>
</form>

<script src="../js/car-listing.js"></script>

<?php include '../includes/footer.php'; ?>