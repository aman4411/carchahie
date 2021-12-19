<?php  

    require_once '../includes/dbconfig.php';
    //Server Side Validation 


    if(!isset($_POST['listingId']) || empty($_POST['listingId'])){
        echo json_encode('Invalid Request');
        exit;
    } 

    $listingId = $_POST['listingId'];

    $conn = getDBConnection();

    if($conn->connect_error){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        echo json_encode('Some Error Occured. Please try again later.');
    }else{
        $deleteQuery = "Update car_listing SET listingStatus=1 where listingId=?";
        $stmt= $conn->prepare($deleteQuery);
        $stmt->bind_param("s", $listingId);
        if($result = $stmt->execute()){
            echo json_encode('Success');
        }else{
            echo json_encode('Bad Request');
        }
    }
    
    closeDbConnection($conn);
    exit;
?>
