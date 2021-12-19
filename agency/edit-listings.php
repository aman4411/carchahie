<?php $currentPage = "Your Listings";
include '../includes/header.php';

if (!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')) {
  header('Location: ../login.php');
}

$model = $_GET['model'];
$number = $_GET['number'];
$capacity = $_GET['capacity'];
$rent = $_GET['rent'];
$listingId = $_GET['listingId'];
?>

<form class="col-12 col-md-8 col-lg-8 col-xl-6 mt-5" id="update-car-form" onsubmit="validateUpdateCarForm(event,<?=$listingId?>)">
  <div class="row">
    <div class="col text-center mt-3">
      <h3>Update Your Car Listing</h3>
    </div>
  </div>
  <div class="row align-items-center">
    <div class="col mt-4">
      <input type="text" name="model" class="form-control" value="<?= $model ?>" placeholder="Model Name">
    </div>
  </div>
  <div class="row align-items-center mt-4">
    <div class="col">
      <input type="text" name="number" class="form-control" value="<?= $number ?>" placeholder="Vehicle Number">
    </div>
  </div>
  <div class="row align-items-center mt-4">
    <div class="col">
      <input type="number" name="capacity" class="form-control" value="<?= $capacity ?>" placeholder="Sitting Capacity">
    </div>
  </div>
  <div class="row align-items-center mt-4">
    <div class="col">
      <input type="number" name="rent" class="form-control" value="<?= $rent ?>" placeholder="Rent/Day (&#8377;)">
    </div>
  </div>
  <div class="row justify-content-start mt-4">
    <div class="col">
      <span class="text-danger" id="update-car-form-error">*Error</span>
      <button class="btn btn-primary mt-3" type="submit" id="update-car-button">Update</button>
      <button id="update-car-loading-button" class="btn btn-primary mt-3" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
      </button>
    </div>
  </div>
</form>

<script src="../js/car-listing.js"></script>

<?php include '../includes/footer.php'; ?>