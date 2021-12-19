<?php  
    require_once '../includes/dbconfig.php';
    include '../models/bookings.php';
    //Server Side Validation 

    if(!isset($_POST['customerId']) || empty($_POST['customerId']) || !isset($_POST['agencyId']) || empty($_POST['agencyId']) || !isset($_POST['listingId']) || empty($_POST['listingId'])){
        echo json_encode('Invalid Request');
        exit;
    } 
    if(!isset($_POST['bookingStartDate']) || empty($_POST['bookingStartDate'])){
        echo json_encode('Booking Start Date is not specified');
        exit;
    }
    if(!isset($_POST['bookingDays']) || empty($_POST['bookingDays'])){
        echo json_encode('Bookings Days are not specified');
        exit;
    }

    $booking = new Booking();
    $booking->customerId = $_POST['customerId'];
    $booking->agencyId = $_POST['agencyId'];
    $booking->listingId = $_POST['listingId'];
    $booking->bookingStartDate = $_POST['bookingStartDate'];
    $booking->bookingDays = $_POST['bookingDays'];


    $conn = getDBConnection();

    if($conn->connect_error){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        echo json_encode('Some Error Occured. Please try again later.');
    }else{
        $insertQuery = "INSERT INTO car_booking (customerId,agencyId, listingId, bookingStartDate,bookingDays) VALUES (?,?,?,?,?)";
        $stmt= $conn->prepare($insertQuery);
        $stmt->bind_param("sssss", $booking->customerId,$booking->agencyId,$booking->listingId,$booking->bookingStartDate,$booking->bookingDays);
        if($result = $stmt->execute()){
            echo json_encode('Success');
        }else{
            echo json_encode($stmt->error);
        }
    }
    
    closeDbConnection($conn);
    exit;
?>
