<?php $currentPage = "Home";
require_once './includes/dbconfig.php';
include './includes/header.php';

$conn = getDBConnection();
$conn = getDBConnection();

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    $selectQuery = "SELECT * from car_listing where listingStatus is NULL";
    $stmt = $conn->prepare($selectQuery);
    $stmt->execute();
    $result = $stmt->get_result();
}

?>

<div class="conatiner">
    <img id="banner" src="./assets/logo.png" alt="">
</div>

<div class="container">
    <div class="row">
        <div class="col text-center mt-5">
            <h3>Top Listed Cars Available for Rent</h3>
        </div>
    </div>
    <div class="row mt-5 mb-5">

        <?php
        while ($dbCar = $result->fetch_assoc()) {
        ?>
            <div class="col-md-3 xs-mr-5 col-sm-6 item mb-3">
                <div class="card item-card card-block">
                    <img class="card-img" src="./assets/sample-car.jpg" alt="Photo of sunset">
                    <h5 class="card-title mt-1 mb-1"><?php echo $dbCar['model'] ?></h5>
                    <h6 class="mt-3 text-center text-primary"><?php echo $dbCar['number'] ?></h6>
                    <p class="text-center">Capacity : <?php echo $dbCar['capacity'] ?> Person</p>
                    <p class="text-center text-danger">Rent : <?php echo $dbCar['rent'] ?>/day</p>
                    <button class="btn btn-primary">Book Now</button>
                </div>
            </div>
        <?php
        }
        ?>


        <!-- <div class="col-md-3 mr-3 col-sm-6 item mb-3">
            <div class="card item-card card-block">
                <img class="card-img" src="./assets/sample-car.jpg" alt="Photo of sunset">
                <h5 class="card-title  mt-3 mb-3">ProVyuh</h5>
                <p class="card-text">This is a company that builds websites, web .</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 item mb-3">
            <div class="card item-card card-block">
                <img class="card-img" src="./assets/sample-car.jpg" alt="Photo of sunset">
                <h5 class="card-title  mt-3 mb-3">ProVyuh</h5>
                <p class="card-text">This is a company that builds websites, web apps and e-commerce solutions.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 item mb-3">
            <div class="card item-card card-block">
                <img class="card-img" src="./assets/sample-car.jpg" alt="Photo of sunset">
                <h5 class="card-title  mt-3 mb-3">ProVyuh</h5>
                <p class="card-text">This is a company that builds websites, web apps and e-commerce solutions.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 item">
            <div class="card item-card card-block">
                <img class="card-img" src="./assets/sample-car.jpg" alt="Photo of sunset">
                <h5 class="card-title  mt-3 mb-3">ProVyuh</h5>
                <p class="card-text">This is a company that builds websites, web apps and e-commerce solutions.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 item">
            <div class="card item-card card-block">
                <img class="card-img" src="./assets/sample-car.jpg" alt="Photo of sunset">
                <h5 class="card-title  mt-3 mb-3">ProVyuh</h5>
                <p class="card-text">This is a company that builds websites, web apps and e-commerce solutions.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 item">
            <div class="card item-card card-block">
                <img class="card-img" src="./assets/sample-car.jpg" alt="Photo of sunset">
                <h5 class="card-title  mt-3 mb-3">ProVyuh</h5>
                <p class="card-text">This is a company that builds websites, web apps and e-commerce solutions.</p>
            </div>
        </div> -->
    </div>
</div>

<?php include './includes/footer.php' ?>