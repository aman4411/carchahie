<?php $currentPage = "Home";
require_once './includes/dbconfig.php';
include './includes/header.php';

$conn = getDBConnection();

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    $selectQuery = "SELECT * from car_listing where listingStatus is NULL";
    $stmt = $conn->prepare($selectQuery);
    $stmt->execute();
    $result = $stmt->get_result();
}

function handleBookNowButtonClick($dbCar){
   if(isset($_SESSION['userRole'])){
       if($_SESSION['userRole'] == 'agency'){
           echo "promptyAgencyNotAllowedForBooking()";
       }else{
           $path = "'".'/customer/create-order.php?listingId='.$dbCar['listingId']."'";
           echo "handleBooking(".$path.")";
       }
   }else{
       return "redirectToLoginPage()";
   }
}

?>

<div class="conatiner mt-5">
    <img id="banner" src="./assets/logo.png" alt="">
</div>

<div class="container">
    <div class="row">
        <div class="col text-center mt-5">
            <h3>Top Listed Cars Available for Rent</h3>
        </div>
    </div>
    <div class="row mt-5 mb-5">

        <?php while ($dbCar = $result->fetch_assoc()): ?>
            <div class="col-md-3 xs-mr-5 col-sm-6 item mb-3">
                <div class="card item-card card-block">
                    <img class="card-img" src="./assets/sample-car.jpg" alt="Photo of sunset">
                    <h5 class="card-title mt-1 mb-1"><?= $dbCar['model'] ?></h5>
                    <h6 class="mt-3 text-center text-primary"><?= $dbCar['number'] ?></h6>
                    <p class="text-center">Capacity : <?= $dbCar['capacity'] ?> Person</p>
                    <p class="text-center text-danger">Rent : &#8377;<?= $dbCar['rent'] ?>/day</p>
                    <button class="btn btn-primary" onclick="<?= handleBookNowButtonClick($dbCar)?>">Book Now</button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include './includes/footer.php' ?>