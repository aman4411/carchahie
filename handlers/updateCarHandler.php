<?php  

    include '../models/car-listing.php';

    require_once '../includes/dbconfig.php';
    //Server Side Validation 


    if(!isset($_POST['listingId']) || empty($_POST['listingId'])){
        echo json_encode('Invalid Request');
        exit;
    } 
    if(!isset($_POST['model']) || empty($_POST['model'])){
        echo json_encode('Model Name is not specified');
        exit;
    } 
    if(!isset($_POST['number']) || empty($_POST['number'])){
        echo json_encode('Vehicle Number is not specified');
        exit;
    }
    if(!isset($_POST['capacity']) || empty($_POST['capacity'])){
        echo json_encode('Car Capacity is not specified');
        exit;
    }
    if(!isset($_POST['rent']) || empty($_POST['rent'])){
        echo json_encode('Rent Amount is not specified');
        exit;
    }

    $car = new CarListing();
    $car->model = $_POST['model'];
    $car->number = $_POST['number'];
    $car->capacity = $_POST['capacity'];
    $car->rent = $_POST['rent'];
    $car->listingId = $_POST['listingId'];

    $conn = getDBConnection();

    if($conn->connect_error){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        echo json_encode('Some Error Occured. Please try again later.');
    }else{
        $updateQuery = "Update car_listing SET model=?, number=?, capacity=?, rent=? where listingId=?";
        $stmt= $conn->prepare($updateQuery);
        $stmt->bind_param("sssss", $car->model, $car->number, $car->capacity, $car->rent,$car->listingId);
        if($result = $stmt->execute()){
            echo json_encode('Success');
        }else{
            echo json_encode('Bad Request');
        }
    }
    
    closeDbConnection($conn);
    exit;
?>
