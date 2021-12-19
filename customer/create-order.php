<?php $currentPage = "Bookings";
require_once '../includes/dbconfig.php';
include '../includes/header.php';

if (!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'customer')) {
    header('Location: ../login.php');
}

$listingId = $_GET['listingId'];

if (!isset($listingId) || empty($listingId)){
    echo "<script type='text/javascript'>window.location.href='/index.php';</script>"; 
    exit;
}

$conn = getDBConnection();
if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    $selectQuery = "SELECT * from car_listing where listingId=? and listingStatus is NULL";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $listingId);
    $stmt->execute();
    $result = $stmt->get_result();
    $dbCar = $result->fetch_assoc();
    if($dbCar){
        $model = $dbCar['model'];
        $number = $dbCar['number'];
        $capacity = $dbCar['capacity'];
        $rent = $dbCar['rent'];
        $listedBy = $dbCar['listedBy'];
    }else{
        echo "<script type='text/javascript'>window.location.href='/index.php';</script>"; 
        exit;
    }
}
?>
<form class="col-12 col-md-8 col-lg-8 col-xl-6 mt-3" id="order-car-form" onsubmit="validateOrderCarForm(event,<?= $_SESSION['userId'] ?>,<?= $listingId ?>,<?= $listedBy ?>)">
    <div class="row">
        <div class="col text-center mt-3">
            <h3>Order Car on Rent</h3>
            <p class="text-h3">Place your order and you will be ready to get this car on rent. </p>
        </div>
    </div>
    <div class="row form-group align-items-center mt-3">
        <label for="model" class="col-sm-4 col-form-label">Car Model</label>
        <div class="col-sm-8">
            <input type="text" name="model" class="form-control" value="<?= $model ?>" readonly>
        </div>
    </div>
    <div class="row form-group align-items-center mt-3">
        <label for="number" class="col-sm-4 col-form-label">Vehicle Number</label>
        <div class="col-sm-8">
            <input type="text" name="number" class="form-control" value="<?= $number ?>" readonly>
        </div>
    </div>
    <div class="row form-group align-items-center mt-3">
        <label for="capacity" class="col-sm-4 col-form-label">Car Capacity</label>
        <div class="col-sm-8">
            <input type="number" name="capacity" class="form-control" value="<?= $capacity ?>" readonly>
        </div>
    </div>
    <div class="row form-group align-items-center mt-3">
        <label for="rent" class="col-sm-4 col-form-label">Rent/Day (&#8377;)</label>
        <div class="col-sm-8">
            <input type="number" name="rent" class="form-control" value="<?= $rent ?>" readonly>
        </div>
    </div>
    <div class="row form-group align-items-center mt-3">
        <label for="rent" class="col-sm-4 col-form-label">Booking Start Date</label>
        <div class="col-sm-8">
            <input type="date" name="startDate" class="form-control" placeholder="dd/mm/yyyy">
        </div>
    </div>
    <div class="row form-group align-items-center mt-3">
        <label for="days" class="col-sm-4 col-form-label">Days Required</label>
        <div class="col-sm-8">
            <select class="form-control" name="days" id="days">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
    </div>
    <div class="row justify-content-start mt-2">
        <div class="col">
            <span class="text-danger" id="order-car-form-error">*Error</span>
            <button class="btn btn-primary offset-sm-4 mt-3" type="submit" id="order-car-button">Book Car</button>
            <button id="order-car-loading-button" class="btn btn-primary offset-sm-4 mt-3" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </button>
        </div>
    </div>
</form>

<script src="../js/car-listing.js"></script>
<?php include '../includes/footer.php'; ?>