<?php  

    include '../models/car-listing.php';

    require_once '../includes/dbconfig.php';
    //Server Side Validation 

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
    if(!isset($_POST['userId']) || empty($_POST['userId'])){
        echo json_encode('Bad Request');
        exit;
    }

    $car = new CarListing();
    $car->listedBy = $_POST['userId'];
    $car->model = $_POST['model'];
    $car->number = $_POST['number'];
    $car->capacity = $_POST['capacity'];
    $car->rent = $_POST['rent'];


    $conn = getDBConnection();

    if($conn->connect_error){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        echo json_encode('Some Error Occured. Please try again later.');
    }else{
        $insertQuery = "INSERT INTO car_listing (listedBy,model, number, capacity,rent) VALUES (?,?,?,?,?)";
        $stmt= $conn->prepare($insertQuery);
        $stmt->bind_param("sssss", $car->listedBy, $car->model, $car->number, $car->capacity,$car->rent);
        if($result = $stmt->execute()){
            echo json_encode('Success');
        }else{
            echo json_encode($stmt->error);
        }
    }
    
    closeDbConnection($conn);
    exit;
?>
