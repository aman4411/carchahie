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
?>

<div class="container table-responsive py-5">
    <div class="row">
        <div class="col text-center mt-3">
            <h3>Your Car Rental Orders</h3>
            <p class="text-h3">View all your bookings here</p>
        </div>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Booking Id</th>
                <th scope="col">Model Name</th>
                <th scope="col">Vehicle Number</th>
                <th scope="col">Capacity</th>
                <th scope="col">Rent/Day</th>
                <th scope="col">Booking Start Date</th>
                <th scope="col">Days Booked For</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($booking = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $booking['bookingId'] ?></td>
                    <td><?php echo $booking['model'] ?></td>
                    <td><?php echo $booking['number'] ?></td>
                    <td><?php echo $booking['capacity'] ?></td>
                    <td><?php echo $booking['rent'] ?></td>
                    <td><?php echo $booking['bookingStartDate'] ?></td>
                    <td><?php echo $booking['bookingDays'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>


<?php include '../includes/footer.php'; ?>