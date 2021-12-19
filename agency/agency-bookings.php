<?php $currentPage="Bookings";
require_once '../includes/dbconfig.php';
include '../includes/header.php';

if(!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')){
  header('Location: ../login.php');
}

$conn = getDBConnection();

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    $selectQuery = "SELECT * FROM `car_booking` INNER JOIN car_listing ON car_booking.listingId = car_listing.listingId where agencyId=?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $_SESSION['userId']);
    $stmt->execute();
    $result = $stmt->get_result();
}

include '../includes/booking-table.php';
include '../includes/footer.php';
?>