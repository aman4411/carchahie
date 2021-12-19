<?php $currentPage = "Your Listings";
include '../includes/header.php';
require_once '../includes/dbconfig.php';

if (!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')) {
    header('Location: ../login.php');
}

$conn = getDBConnection();

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    $selectQuery = "SELECT * from car_listing where listedBy=? and listingStatus is NULL";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $_SESSION['userId']);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>


<div class="container table-responsive py-5">
    <div class="row">
        <div class="col text-center mt-3">
            <h3>Listed Cars</h3>
            <p class="text-h3">Manage all your listed cars here.</p>
        </div>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Model Name</th>
                <th scope="col">Model Number</th>
                <th scope="col">Capacity</th>
                <th scope="col">Rent</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($car = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $car['model'] ?></td>
                    <td><?php echo $car['number'] ?></td>
                    <td><?php echo $car['capacity'] ?></td>
                    <td><?php echo $car['rent'] ?></td>
                    <td><button class="btn btn-primary" onclick="location.href='./edit-listings.php?model=<?= $car['model'] ?>&number=<?= $car['number'] ?>&capacity=<?= $car['capacity'] ?>&rent=<?= $car['rent'] ?>&listingId=<?= $car['listingId'] ?>'">Edit</button></td>
                    <td>
                        <button id="delete-car-button" class="btn btn-danger" onclick="confirmDeleteCarListing(<?= $car['listingId'] ?>)">Delete</button>
                        <button id="delete-car-loading-button" class="btn btn-primary mt-3" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Deleting...
                        </button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<script src="../js/car-listing.js"></script>
<?php include '../includes/footer.php'; ?>