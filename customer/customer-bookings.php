<?php $currentPage="Bookings";
include '../includes/header.php';
require_once '../includes/dbconfig.php';

if(!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'customer')){
  header('Location: ../login.php');
}

$conn = getDBConnection();

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    $selectQuery = "SELECT * FROM `car_booking` INNER JOIN car_listing ON car_booking.listingId = car_listing.listingId where customerId=?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $_SESSION['userId']);
    $stmt->execute();
    $result = $stmt->get_result();
}

include '../includes/booking-table.php';
include '../includes/footer.php';
?>
